import React, { useState } from 'react';
import { useWeather } from '../contexts/WeatherContext';
import SearchBar from './SearchBar';
import CurrentWeather from './CurrentWeather';
import ForecastCards from './ForecastCards';
import HourlyForecast from './HourlyForecast';
import WeatherDetails from './WeatherDetails';
import FavoriteCities from './FavoriteCities';
import LoadingSpinner from './LoadingSpinner';
import { Card } from './ui/card';

const WeatherDashboard = () => {
  const { currentWeather, forecast, hourlyForecast, loading, error } = useWeather();
  const [activeTab, setActiveTab] = useState('current');

  const tabs = [
    { id: 'current', name: 'Hazırkı Hava' },
    { id: 'forecast', name: '5 Günlük' },
    { id: 'hourly', name: 'Saatlıq' },
    { id: 'favorites', name: 'Sevimlilər' }
  ];

  if (loading) return <LoadingSpinner />;
  if (error) return (
    <div className="min-h-screen flex items-center justify-center">
      <Card className="p-8 bg-red-50 border-red-200">
        <div className="text-red-600 text-center">
          <h2 className="text-2xl font-bold mb-2">Xəta baş verdi</h2>
          <p>{error}</p>
        </div>
      </Card>
    </div>
  );

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 p-4">
      <div className="max-w-6xl mx-auto">
        {/* Header */}
        <div className="text-center mb-8">
          <h1 className="text-5xl font-bold text-white mb-4 drop-shadow-lg">
            🌤️ Hava Proqnozu
          </h1>
          <p className="text-xl text-white/90">Hazırkı hava vəziyyəti və proqnoz</p>
        </div>

        {/* Search Bar */}
        <div className="mb-8">
          <SearchBar />
        </div>

        {/* Navigation Tabs */}
        <div className="flex justify-center mb-8">
          <div className="bg-white/20 backdrop-blur-lg rounded-2xl p-2">
            <div className="flex gap-2">
              {tabs.map((tab) => (
                <button
                  key={tab.id}
                  onClick={() => setActiveTab(tab.id)}
                  className={`px-6 py-3 rounded-xl font-medium transition-all duration-300 ${
                    activeTab === tab.id
                      ? 'bg-white text-purple-600 shadow-lg transform scale-105'
                      : 'text-white hover:bg-white/20'
                  }`}
                >
                  {tab.name}
                </button>
              ))}
            </div>
          </div>
        </div>

        {/* Content */}
        <div className="space-y-6">
          {activeTab === 'current' && (
            <div className="space-y-6">
              <CurrentWeather weather={currentWeather} />
              <WeatherDetails weather={currentWeather} />
            </div>
          )}

          {activeTab === 'forecast' && (
            <ForecastCards forecast={forecast} />
          )}

          {activeTab === 'hourly' && (
            <HourlyForecast hourlyData={hourlyForecast} />
          )}

          {activeTab === 'favorites' && (
            <FavoriteCities />
          )}
        </div>
      </div>
    </div>
  );
};

export default WeatherDashboard;