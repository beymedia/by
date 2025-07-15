import React from 'react';
import { Card } from './ui/card';
import { Droplets, Wind } from 'lucide-react';

const ForecastCards = ({ forecast }) => {
  if (!forecast || forecast.length === 0) return null;

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
    <div className="space-y-6">
      <h2 className="text-3xl font-bold text-white text-center mb-6">5 Günlük Proqnoz</h2>
      
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
        {forecast.map((day, index) => (
          <Card 
            key={index} 
            className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl hover:bg-white/30 transition-all duration-300 hover:scale-105 cursor-pointer"
          >
            <div className="p-6 text-center">
              {/* Day */}
              <h3 className="text-lg font-semibold text-white mb-3">
                {index === 0 ? 'Bu gün' : day.date}
              </h3>

              {/* Weather Icon */}
              <div className="text-4xl mb-4">
                {weatherIcons[day.icon] || '☀️'}
              </div>

              {/* Description */}
              <p className="text-white/80 text-sm mb-4">{day.description}</p>

              {/* Temperature */}
              <div className="mb-4">
                <div className="flex items-center justify-center gap-2">
                  <span className="text-2xl font-bold text-white">{day.high}°</span>
                  <span className="text-lg text-white/70">{day.low}°</span>
                </div>
              </div>

              {/* Weather Details */}
              <div className="space-y-2">
                <div className="flex items-center justify-center gap-2">
                  <Droplets className="w-4 h-4 text-white/70" />
                  <span className="text-white/80 text-sm">{day.humidity}%</span>
                </div>
                <div className="flex items-center justify-center gap-2">
                  <Wind className="w-4 h-4 text-white/70" />
                  <span className="text-white/80 text-sm">{day.wind_speed} km/s</span>
                </div>
              </div>
            </div>
          </Card>
        ))}
      </div>
    </div>
  );
};

export default ForecastCards;