import React from 'react';
import { Card } from './ui/card';
import { Thermometer, Wind, Droplets, Eye, Gauge, Sun } from 'lucide-react';

const CurrentWeather = ({ weather }) => {
  if (!weather) return null;

  const weatherIcons = {
    '01d': '☀️',
    '02d': '⛅',
    '03d': '☁️',
    '04d': '☁️',
    '09d': '🌧️',
    '10d': '🌦️',
    '11d': '⛈️',
    '13d': '❄️',
    '50d': '🌫️'
  };

  return (
    <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl overflow-hidden">
      <div className="p-8">
        <div className="flex items-center justify-between mb-6">
          <div>
            <h2 className="text-3xl font-bold text-white mb-2">
              {weather.city}, {weather.country}
            </h2>
            <p className="text-white/80 text-lg">{weather.description}</p>
          </div>
          <div className="text-6xl">
            {weatherIcons[weather.icon] || '☀️'}
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {/* Temperature */}
          <div className="text-center">
            <div className="flex items-center justify-center gap-2 mb-2">
              <Thermometer className="w-6 h-6 text-white/80" />
              <span className="text-white/80 text-lg">Temperatur</span>
            </div>
            <div className="text-6xl font-bold text-white mb-2">
              {weather.temperature}°
            </div>
            <p className="text-white/70">
              Hiss olunur: {weather.feels_like}°
            </p>
          </div>

          {/* Weather Stats */}
          <div className="space-y-4">
            <div className="flex items-center gap-3">
              <Wind className="w-5 h-5 text-white/80" />
              <span className="text-white/80">Külək:</span>
              <span className="text-white font-semibold">
                {weather.wind_speed} km/s {weather.wind_direction}
              </span>
            </div>

            <div className="flex items-center gap-3">
              <Droplets className="w-5 h-5 text-white/80" />
              <span className="text-white/80">Nem:</span>
              <span className="text-white font-semibold">{weather.humidity}%</span>
            </div>

            <div className="flex items-center gap-3">
              <Gauge className="w-5 h-5 text-white/80" />
              <span className="text-white/80">Təzyiq:</span>
              <span className="text-white font-semibold">{weather.pressure} hPa</span>
            </div>

            <div className="flex items-center gap-3">
              <Eye className="w-5 h-5 text-white/80" />
              <span className="text-white/80">Görmə məsafəsi:</span>
              <span className="text-white font-semibold">{weather.visibility} km</span>
            </div>
          </div>
        </div>

        {/* Sun Info */}
        <div className="mt-8 pt-6 border-t border-white/20">
          <div className="flex items-center justify-center gap-8">
            <div className="flex items-center gap-2">
              <Sun className="w-5 h-5 text-yellow-300" />
              <span className="text-white/80">Gündoğan:</span>
              <span className="text-white font-semibold">{weather.sunrise}</span>
            </div>
            <div className="flex items-center gap-2">
              <Sun className="w-5 h-5 text-orange-300" />
              <span className="text-white/80">Günbatan:</span>
              <span className="text-white font-semibold">{weather.sunset}</span>
            </div>
          </div>
        </div>
      </div>
    </Card>
  );
};

export default CurrentWeather;