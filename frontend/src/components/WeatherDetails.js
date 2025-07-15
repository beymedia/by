import React from 'react';
import { Card } from './ui/card';
import { 
  Thermometer, 
  Wind, 
  Droplets, 
  Eye, 
  Gauge, 
  Sun, 
  Compass,
  Activity
} from 'lucide-react';

const WeatherDetails = ({ weather }) => {
  if (!weather) return null;

  const details = [
    {
      icon: <Thermometer className="w-6 h-6 text-blue-400" />,
      title: 'Hiss olunur',
      value: `${weather.feels_like}°`,
      description: 'Həqiqi temperatur hissi'
    },
    {
      icon: <Wind className="w-6 h-6 text-green-400" />,
      title: 'Külək Sürəti',
      value: `${weather.wind_speed} km/s`,
      description: `İstiqamət: ${weather.wind_direction}`
    },
    {
      icon: <Droplets className="w-6 h-6 text-cyan-400" />,
      title: 'Nem',
      value: `${weather.humidity}%`,
      description: 'Havadakı nəmlik səviyyəsi'
    },
    {
      icon: <Gauge className="w-6 h-6 text-purple-400" />,
      title: 'Atmosfer Təzyiqi',
      value: `${weather.pressure} hPa`,
      description: 'Hava təzyiqi göstəricisi'
    },
    {
      icon: <Eye className="w-6 h-6 text-yellow-400" />,
      title: 'Görmə Məsafəsi',
      value: `${weather.visibility} km`,
      description: 'Maksimum görmə məsafəsi'
    },
    {
      icon: <Activity className="w-6 h-6 text-orange-400" />,
      title: 'UV İndeksi',
      value: weather.uv_index,
      description: 'Ultrabənövşəyi şüa səviyyəsi'
    }
  ];

  return (
    <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
      <div className="p-6">
        <h2 className="text-2xl font-bold text-white mb-6 text-center">
          Ətraflı Məlumat
        </h2>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {details.map((detail, index) => (
            <div 
              key={index}
              className="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105"
            >
              <div className="flex items-center gap-3 mb-3">
                {detail.icon}
                <h3 className="text-white font-semibold">{detail.title}</h3>
              </div>
              
              <div className="mb-2">
                <span className="text-2xl font-bold text-white">{detail.value}</span>
              </div>
              
              <p className="text-white/70 text-sm">{detail.description}</p>
            </div>
          ))}
        </div>

        {/* Additional Info */}
        <div className="mt-8 pt-6 border-t border-white/20">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20">
              <div className="flex items-center gap-3 mb-3">
                <Sun className="w-6 h-6 text-yellow-400" />
                <h3 className="text-white font-semibold">Gün Dövrü</h3>
              </div>
              <div className="space-y-2">
                <div className="flex justify-between">
                  <span className="text-white/80">Gündoğan:</span>
                  <span className="text-white font-semibold">{weather.sunrise}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-white/80">Günbatan:</span>
                  <span className="text-white font-semibold">{weather.sunset}</span>
                </div>
              </div>
            </div>

            <div className="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20">
              <div className="flex items-center gap-3 mb-3">
                <Compass className="w-6 h-6 text-pink-400" />
                <h3 className="text-white font-semibold">Külək Məlumatı</h3>
              </div>
              <div className="space-y-2">
                <div className="flex justify-between">
                  <span className="text-white/80">Sürət:</span>
                  <span className="text-white font-semibold">{weather.wind_speed} km/s</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-white/80">İstiqamət:</span>
                  <span className="text-white font-semibold">{weather.wind_direction}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Card>
  );
};

export default WeatherDetails;