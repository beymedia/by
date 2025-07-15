import React, { useState, useEffect } from 'react';
import { useWeather } from '../contexts/WeatherContext';
import { Search, MapPin, Star } from 'lucide-react';
import { Card } from './ui/card';
import { Button } from './ui/button';

const SearchBar = () => {
  const { fetchWeatherData, selectedCity, addToFavorites, getUserLocation, searchCities } = useWeather();
  const [query, setQuery] = useState('');
  const [suggestions, setSuggestions] = useState([]);
  const [showSuggestions, setShowSuggestions] = useState(false);

  useEffect(() => {
    const searchCitiesHandler = async () => {
      if (query.length > 1) {
        const cities = await searchCities(query);
        setSuggestions(cities);
        setShowSuggestions(true);
      } else {
        setSuggestions([]);
        setShowSuggestions(false);
      }
    };

    const debounce = setTimeout(searchCitiesHandler, 300);
    return () => clearTimeout(debounce);
  }, [query, searchCities]);

  const handleCitySelect = (city) => {
    setQuery('');
    setShowSuggestions(false);
    // Extract city name from "City, Country" format
    const cityName = city.split(',')[0].trim();
    fetchWeatherData(cityName);
  };

  const handleCurrentLocation = async () => {
    try {
      await getUserLocation();
      // Mock: simulate getting current location as Bakı
      fetchWeatherData('Bakı');
    } catch (error) {
      alert('Yer məlumatı alınmadı. Xahiş olunur şəhər adı daxil edin.');
    }
  };

  const handleAddToFavorites = () => {
    addToFavorites(selectedCity);
  };

  return (
    <div className="relative max-w-2xl mx-auto">
      <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
        <div className="p-4">
          <div className="flex gap-3">
            <div className="flex-1 relative">
              <div className="relative">
                <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-white/70 w-5 h-5" />
                <input
                  type="text"
                  value={query}
                  onChange={(e) => setQuery(e.target.value)}
                  placeholder="Şəhər adı daxil edin..."
                  className="w-full pl-10 pr-4 py-3 bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-300"
                />
              </div>

              {/* Suggestions */}
              {showSuggestions && suggestions.length > 0 && (
                <Card className="absolute top-full mt-2 w-full bg-white/95 backdrop-blur-lg border-white/30 shadow-xl z-10">
                  <div className="max-h-60 overflow-y-auto">
                    {suggestions.map((city, index) => (
                      <button
                        key={index}
                        onClick={() => handleCitySelect(city)}
                        className="w-full px-4 py-3 text-left hover:bg-purple-50 transition-colors duration-200 first:rounded-t-xl last:rounded-b-xl"
                      >
                        <div className="flex items-center gap-3">
                          <MapPin className="w-4 h-4 text-purple-600" />
                          <span className="text-gray-800">{city}</span>
                        </div>
                      </button>
                    ))}
                  </div>
                </Card>
              )}
            </div>

            <Button
              onClick={handleCurrentLocation}
              className="bg-white/20 backdrop-blur-lg border border-white/30 hover:bg-white/30 transition-all duration-300 px-4"
            >
              <MapPin className="w-5 h-5 text-white" />
            </Button>

            <Button
              onClick={handleAddToFavorites}
              className="bg-white/20 backdrop-blur-lg border border-white/30 hover:bg-white/30 transition-all duration-300 px-4"
            >
              <Star className="w-5 h-5 text-white" />
            </Button>
          </div>

          {selectedCity && (
            <div className="mt-3 text-center">
              <span className="text-white/90 text-sm">
                Seçilmiş şəhər: <span className="font-semibold">{selectedCity}</span>
              </span>
            </div>
          )}
        </div>
      </Card>
    </div>
  );
};

export default SearchBar;