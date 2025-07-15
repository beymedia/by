import React from 'react';
import { Card } from './ui/card';
import { ScrollArea } from './ui/scroll-area';
import { Thermometer, Droplets, Wind } from 'lucide-react';

const HourlyForecast = ({ hourlyData }) => {
  if (!hourlyData || hourlyData.length === 0) return null;

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
    <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
      <div className="p-6">
        <h2 className="text-3xl font-bold text-white text-center mb-6">24 Saatlıq Proqnoz</h2>
        
        <ScrollArea className="h-96">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {hourlyData.map((hour, index) => (
              <Card 
                key={index}
                className="bg-white/10 backdrop-blur-lg border-white/20 shadow-lg hover:bg-white/20 transition-all duration-300 cursor-pointer"
              >
                <div className="p-4">
                  {/* Time */}
                  <div className="text-center mb-3">
                    <h3 className="text-lg font-semibold text-white">{hour.time}</h3>
                  </div>

                  {/* Weather Icon and Temperature */}
                  <div className="flex items-center justify-center gap-4 mb-3">
                    <div className="text-3xl">
                      {weatherIcons[hour.icon] || '☀️'}
                    </div>
                    <div className="flex items-center gap-1">
                      <Thermometer className="w-4 h-4 text-white/70" />
                      <span className="text-xl font-bold text-white">{hour.temperature}°</span>
                    </div>
                  </div>

                  {/* Description */}
                  <p className="text-white/80 text-sm text-center mb-3">{hour.description}</p>

                  {/* Weather Details */}
                  <div className="space-y-2">
                    <div className="flex items-center justify-between">
                      <div className="flex items-center gap-2">
                        <Droplets className="w-4 h-4 text-white/70" />
                        <span className="text-white/80 text-sm">Nem</span>
                      </div>
                      <span className="text-white text-sm font-medium">{hour.humidity}%</span>
                    </div>

                    <div className="flex items-center justify-between">
                      <div className="flex items-center gap-2">
                        <Wind className="w-4 h-4 text-white/70" />
                        <span className="text-white/80 text-sm">Külək</span>
                      </div>
                      <span className="text-white text-sm font-medium">{hour.wind_speed} km/s</span>
                    </div>
                  </div>
                </div>
              </Card>
            ))}
          </div>
        </ScrollArea>
      </div>
    </Card>
  );
};

export default HourlyForecast;