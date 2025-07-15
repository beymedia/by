// Mock weather service for frontend development
export const mockWeatherService = {
  getCurrentWeather: async (city) => {
    // Simulate API delay
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    const mockData = {
      'Bakı': {
        city: 'Bakı',
        country: 'AZ',
        temperature: 24,
        feels_like: 26,
        description: 'Açıq',
        humidity: 65,
        wind_speed: 12,
        wind_direction: 'NE',
        pressure: 1013,
        visibility: 10,
        uv_index: 6,
        sunrise: '06:15',
        sunset: '19:45',
        icon: '01d'
      },
      'İstanbul': {
        city: 'İstanbul',
        country: 'TR',
        temperature: 22,
        feels_like: 24,
        description: 'Az buludlu',
        humidity: 70,
        wind_speed: 8,
        wind_direction: 'NW',
        pressure: 1015,
        visibility: 8,
        uv_index: 5,
        sunrise: '06:30',
        sunset: '19:30',
        icon: '02d'
      },
      'London': {
        city: 'London',
        country: 'UK',
        temperature: 16,
        feels_like: 18,
        description: 'Yağışlı',
        humidity: 80,
        wind_speed: 15,
        wind_direction: 'W',
        pressure: 1005,
        visibility: 5,
        uv_index: 3,
        sunrise: '07:00',
        sunset: '18:00',
        icon: '10d'
      }
    };

    return mockData[city] || mockData['Bakı'];
  },

  getForecast: async (city) => {
    await new Promise(resolve => setTimeout(resolve, 800));
    
    const days = ['Bazar', 'Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı'];
    const baseTemp = city === 'Bakı' ? 24 : city === 'İstanbul' ? 22 : 16;
    
    return days.map((day, index) => ({
      date: day,
      high: baseTemp + Math.floor(Math.random() * 6) - 3,
      low: baseTemp - 5 + Math.floor(Math.random() * 4),
      description: ['Açıq', 'Az buludlu', 'Buludlu', 'Yağışlı'][Math.floor(Math.random() * 4)],
      icon: ['01d', '02d', '03d', '10d'][Math.floor(Math.random() * 4)],
      humidity: 60 + Math.floor(Math.random() * 20),
      wind_speed: 8 + Math.floor(Math.random() * 10)
    }));
  },

  getHourlyForecast: async (city) => {
    await new Promise(resolve => setTimeout(resolve, 600));
    
    const hours = [];
    const baseTemp = city === 'Bakı' ? 24 : city === 'İstanbul' ? 22 : 16;
    
    for (let i = 0; i < 24; i++) {
      const hour = (new Date().getHours() + i) % 24;
      hours.push({
        time: `${hour.toString().padStart(2, '0')}:00`,
        temperature: baseTemp + Math.floor(Math.random() * 8) - 4,
        description: ['Açıq', 'Az buludlu', 'Buludlu'][Math.floor(Math.random() * 3)],
        icon: ['01d', '02d', '03d'][Math.floor(Math.random() * 3)],
        humidity: 55 + Math.floor(Math.random() * 30),
        wind_speed: 5 + Math.floor(Math.random() * 15)
      });
    }
    
    return hours;
  },

  searchCities: async (query) => {
    await new Promise(resolve => setTimeout(resolve, 300));
    
    const cities = [
      'Bakı', 'Gəncə', 'Sumqayıt', 'Mingəçevir', 'Naxçıvan',
      'İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Antalya',
      'London', 'Manchester', 'Birmingham', 'Glasgow', 'Liverpool',
      'New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix',
      'Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice',
      'Moscow', 'Saint Petersburg', 'Novosibirsk', 'Yekaterinburg',
      'Tokyo', 'Osaka', 'Yokohama', 'Nagoya', 'Sapporo'
    ];
    
    return cities.filter(city => 
      city.toLowerCase().includes(query.toLowerCase())
    ).slice(0, 10);
  }
};