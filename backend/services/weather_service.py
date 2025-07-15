import requests
import os
from typing import Dict, List, Optional
from datetime import datetime, timedelta
import asyncio
import aiohttp
from dotenv import load_dotenv
from pathlib import Path

# Load environment variables
ROOT_DIR = Path(__file__).parent.parent
load_dotenv(ROOT_DIR / '.env')

class WeatherService:
    def __init__(self):
        self.api_key = os.environ.get('OPENWEATHER_API_KEY')
        if not self.api_key:
            raise ValueError("OPENWEATHER_API_KEY not found in environment variables")
        self.base_url = "https://api.openweathermap.org/data/2.5"
        self.geo_url = "https://api.openweathermap.org/geo/1.0"
        
    async def get_current_weather(self, city: str) -> Dict:
        """Get current weather for a city"""
        try:
            async with aiohttp.ClientSession() as session:
                url = f"{self.base_url}/weather"
                params = {
                    'q': city,
                    'appid': self.api_key,
                    'units': 'metric',
                    'lang': 'az'  # Azerbaijani language
                }
                
                async with session.get(url, params=params) as response:
                    if response.status == 200:
                        data = await response.json()
                        return self._format_current_weather(data)
                    else:
                        raise Exception(f"API Error: {response.status}")
                        
        except Exception as e:
            raise Exception(f"Hava məlumatları alınmadı: {str(e)}")
    
    async def get_coordinates_by_city(self, city: str) -> Dict:
        """Get coordinates for a city"""
        try:
            async with aiohttp.ClientSession() as session:
                url = f"{self.geo_url}/direct"
                params = {
                    'q': city,
                    'limit': 1,
                    'appid': self.api_key
                }
                
                async with session.get(url, params=params) as response:
                    if response.status == 200:
                        data = await response.json()
                        if data:
                            return {
                                'lat': data[0]['lat'],
                                'lon': data[0]['lon'],
                                'city': data[0]['name'],
                                'country': data[0]['country']
                            }
                    raise Exception("Şəhər tapılmadı")
                    
        except Exception as e:
            raise Exception(f"Şəhər koordinatları alınmadı: {str(e)}")
    
    async def get_forecast(self, city: str) -> List[Dict]:
        """Get 5-day forecast for a city"""
        try:
            async with aiohttp.ClientSession() as session:
                url = f"{self.base_url}/forecast"
                params = {
                    'q': city,
                    'appid': self.api_key,
                    'units': 'metric',
                    'lang': 'az'
                }
                
                async with session.get(url, params=params) as response:
                    if response.status == 200:
                        data = await response.json()
                        return self._format_forecast(data)
                    else:
                        raise Exception(f"API Error: {response.status}")
                        
        except Exception as e:
            raise Exception(f"Proqnoz məlumatları alınmadı: {str(e)}")
    
    async def get_hourly_forecast(self, city: str) -> List[Dict]:
        """Get hourly forecast for next 24 hours"""
        try:
            async with aiohttp.ClientSession() as session:
                url = f"{self.base_url}/forecast"
                params = {
                    'q': city,
                    'appid': self.api_key,
                    'units': 'metric',
                    'lang': 'az'
                }
                
                async with session.get(url, params=params) as response:
                    if response.status == 200:
                        data = await response.json()
                        return self._format_hourly_forecast(data)
                    else:
                        raise Exception(f"API Error: {response.status}")
                        
        except Exception as e:
            raise Exception(f"Saatlıq proqnoz alınmadı: {str(e)}")
    
    async def search_cities(self, query: str) -> List[Dict]:
        """Search for cities"""
        try:
            async with aiohttp.ClientSession() as session:
                url = f"{self.geo_url}/direct"
                params = {
                    'q': query,
                    'limit': 10,
                    'appid': self.api_key
                }
                
                async with session.get(url, params=params) as response:
                    if response.status == 200:
                        data = await response.json()
                        return [
                            {
                                'name': city['name'],
                                'country': city['country'],
                                'state': city.get('state', ''),
                                'lat': city['lat'],
                                'lon': city['lon']
                            }
                            for city in data
                        ]
                    else:
                        return []
                        
        except Exception as e:
            return []
    
    def _format_current_weather(self, data: Dict) -> Dict:
        """Format current weather data"""
        return {
            'city': data['name'],
            'country': data['sys']['country'],
            'temperature': round(data['main']['temp']),
            'feels_like': round(data['main']['feels_like']),
            'description': data['weather'][0]['description'].capitalize(),
            'humidity': data['main']['humidity'],
            'wind_speed': round(data['wind']['speed'] * 3.6),  # Convert m/s to km/h
            'wind_direction': self._get_wind_direction(data['wind'].get('deg', 0)),
            'pressure': data['main']['pressure'],
            'visibility': round(data.get('visibility', 0) / 1000),  # Convert m to km
            'uv_index': 0,  # UV index requires separate API call
            'sunrise': datetime.fromtimestamp(data['sys']['sunrise']).strftime('%H:%M'),
            'sunset': datetime.fromtimestamp(data['sys']['sunset']).strftime('%H:%M'),
            'icon': data['weather'][0]['icon']
        }
    
    def _format_forecast(self, data: Dict) -> List[Dict]:
        """Format 5-day forecast data"""
        daily_forecasts = {}
        
        for item in data['list']:
            date = datetime.fromtimestamp(item['dt']).date()
            day_name = self._get_day_name(date)
            
            if date not in daily_forecasts:
                daily_forecasts[date] = {
                    'date': day_name,
                    'high': round(item['main']['temp_max']),
                    'low': round(item['main']['temp_min']),
                    'description': item['weather'][0]['description'].capitalize(),
                    'icon': item['weather'][0]['icon'],
                    'humidity': item['main']['humidity'],
                    'wind_speed': round(item['wind']['speed'] * 3.6)
                }
            else:
                # Update high/low temperatures
                daily_forecasts[date]['high'] = max(daily_forecasts[date]['high'], round(item['main']['temp_max']))
                daily_forecasts[date]['low'] = min(daily_forecasts[date]['low'], round(item['main']['temp_min']))
        
        return list(daily_forecasts.values())[:5]
    
    def _format_hourly_forecast(self, data: Dict) -> List[Dict]:
        """Format hourly forecast data"""
        hourly_data = []
        
        for item in data['list'][:8]:  # Next 24 hours (8 x 3-hour intervals)
            time = datetime.fromtimestamp(item['dt']).strftime('%H:%M')
            
            hourly_data.append({
                'time': time,
                'temperature': round(item['main']['temp']),
                'description': item['weather'][0]['description'].capitalize(),
                'icon': item['weather'][0]['icon'],
                'humidity': item['main']['humidity'],
                'wind_speed': round(item['wind']['speed'] * 3.6)
            })
        
        return hourly_data
    
    def _get_wind_direction(self, degrees: int) -> str:
        """Convert wind degrees to direction"""
        directions = ['S', 'SC', 'C', 'CC', 'Q', 'QC', 'Ş', 'ŞC']
        index = round(degrees / 45) % 8
        return directions[index]
    
    def _get_day_name(self, date) -> str:
        """Get Azerbaijani day name"""
        days = {
            0: 'Bazar ertəsi',
            1: 'Çərşənbə axşamı', 
            2: 'Çərşənbə',
            3: 'Cümə axşamı',
            4: 'Cümə',
            5: 'Şənbə',
            6: 'Bazar'
        }
        return days.get(date.weekday(), 'Naməlum')

# Create global instance
weather_service = WeatherService()