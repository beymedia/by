import React from 'react';
import { useWeather } from '../contexts/WeatherContext';
import { Card } from './ui/card';
import { Button } from './ui/button';
import { Star, Trash2, MapPin } from 'lucide-react';

const FavoriteCities = () => {
  const { favorites, removeFromFavorites, fetchWeatherData } = useWeather();

  const handleCityClick = (cityName) => {
    fetchWeatherData(cityName);
  };

  const handleRemoveFavorite = (cityName, e) => {
    e.stopPropagation();
    removeFromFavorites(cityName);
  };

  if (favorites.length === 0) {
    return (
      <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
        <div className="p-12 text-center">
          <Star className="w-16 h-16 text-white/50 mx-auto mb-4" />
          <h2 className="text-2xl font-bold text-white mb-2">Sevimli Şəhər Yoxdur</h2>
          <p className="text-white/80">
            Şəhər axtarışı zamanı ulduz düyməsini basaraq sevimli şəhərlərinizi əlavə edin.
          </p>
        </div>
      </Card>
    );
  }

  return (
    <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
      <div className="p-6">
        <h2 className="text-3xl font-bold text-white text-center mb-6">
          Sevimli Şəhərlər
        </h2>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {favorites.map((city) => (
            <Card 
              key={city.id}
              className="bg-white/10 backdrop-blur-lg border-white/20 shadow-lg hover:bg-white/20 transition-all duration-300 hover:scale-105 cursor-pointer"
              onClick={() => handleCityClick(city.name)}
            >
              <div className="p-4">
                <div className="flex items-center justify-between">
                  <div className="flex items-center gap-3">
                    <MapPin className="w-5 h-5 text-white/70" />
                    <span className="text-white font-semibold text-lg">{city.name}</span>
                  </div>
                  
                  <Button
                    variant="ghost"
                    size="sm"
                    onClick={(e) => handleRemoveFavorite(city.name, e)}
                    className="text-red-400 hover:text-red-300 hover:bg-red-400/20 p-2"
                  >
                    <Trash2 className="w-4 h-4" />
                  </Button>
                </div>
                
                <div className="mt-3 pt-3 border-t border-white/20">
                  <p className="text-white/70 text-sm text-center">
                    Hava məlumatlarını görmək üçün kliklə
                  </p>
                </div>
              </div>
            </Card>
          ))}
        </div>
        
        <div className="mt-8 p-4 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20">
          <div className="flex items-center gap-3 text-white/80">
            <Star className="w-5 h-5 text-yellow-400" />
            <p className="text-sm">
              <span className="font-semibold">Məsləhət:</span> Şəhər axtarışı zamanı ulduz düyməsini basaraq yeni şəhərlər əlavə edə bilərsiniz.
            </p>
          </div>
        </div>
      </div>
    </Card>
  );
};

export default FavoriteCities;