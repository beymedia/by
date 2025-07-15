import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

const BACKEND_URL = process.env.REACT_APP_BACKEND_URL;
const API = `${BACKEND_URL}/api`;

const WeatherContext = createContext();

export const useWeather = () => {
  const context = useContext(WeatherContext);
  if (!context) {
    throw new Error('useWeather must be used within a WeatherProvider');
  }
  return context;
};

export const WeatherProvider = ({ children }) => {
  const [currentWeather, setCurrentWeather] = useState(null);
  const [forecast, setForecast] = useState(null);
  const [hourlyForecast, setHourlyForecast] = useState(null);
  const [favorites, setFavorites] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [selectedCity, setSelectedCity] = useState('Bakı');

  // Load favorites from localStorage
  useEffect(() => {
    const savedFavorites = localStorage.getItem('weatherFavorites');
    if (savedFavorites) {
      setFavorites(JSON.parse(savedFavorites));
    }
  }, []);

  // Save favorites to localStorage
  useEffect(() => {
    localStorage.setItem('weatherFavorites', JSON.stringify(favorites));
  }, [favorites]);

  const fetchWeatherData = async (city) => {
    setLoading(true);
    setError(null);
    
    try {
      const [currentData, forecastData, hourlyData] = await Promise.all([
        axios.get(`${API}/weather/current/${encodeURIComponent(city)}`),
        axios.get(`${API}/weather/forecast/${encodeURIComponent(city)}`),
        axios.get(`${API}/weather/hourly/${encodeURIComponent(city)}`)
      ]);

      setCurrentWeather(currentData.data);
      setForecast(forecastData.data);
      setHourlyForecast(hourlyData.data);
      setSelectedCity(city);
    } catch (err) {
      setError(err.response?.data?.detail || 'Hava məlumatları alınmadı');
    } finally {
      setLoading(false);
    }
  };

  const searchCities = async (query) => {
    try {
      const response = await axios.get(`${API}/weather/search/${encodeURIComponent(query)}`);
      return response.data.map(city => `${city.name}, ${city.country}`);
    } catch (err) {
      return [];
    }
  };

  const addToFavorites = (city) => {
    if (!favorites.find(fav => fav.name === city)) {
      setFavorites([...favorites, { name: city, id: Date.now() }]);
    }
  };

  const removeFromFavorites = (cityName) => {
    setFavorites(favorites.filter(fav => fav.name !== cityName));
  };

  const getUserLocation = () => {
    return new Promise((resolve, reject) => {
      if (!navigator.geolocation) {
        reject(new Error('Geolocation is not supported'));
        return;
      }

      navigator.geolocation.getCurrentPosition(
        (position) => {
          resolve({
            lat: position.coords.latitude,
            lon: position.coords.longitude
          });
        },
        (error) => {
          reject(error);
        }
      );
    });
  };

  // Initialize with default city
  useEffect(() => {
    fetchWeatherData(selectedCity);
  }, []);

  const value = {
    currentWeather,
    forecast,
    hourlyForecast,
    favorites,
    loading,
    error,
    selectedCity,
    fetchWeatherData,
    searchCities,
    addToFavorites,
    removeFromFavorites,
    getUserLocation
  };

  return (
    <WeatherContext.Provider value={value}>
      {children}
    </WeatherContext.Provider>
  );
};