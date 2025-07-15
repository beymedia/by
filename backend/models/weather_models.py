from pydantic import BaseModel
from typing import List, Optional
from datetime import datetime

class CurrentWeatherResponse(BaseModel):
    city: str
    country: str
    temperature: int
    feels_like: int
    description: str
    humidity: int
    wind_speed: int
    wind_direction: str
    pressure: int
    visibility: int
    uv_index: int
    sunrise: str
    sunset: str
    icon: str

class ForecastDayResponse(BaseModel):
    date: str
    high: int
    low: int
    description: str
    icon: str
    humidity: int
    wind_speed: int

class HourlyForecastResponse(BaseModel):
    time: str
    temperature: int
    description: str
    icon: str
    humidity: int
    wind_speed: int

class CitySearchResponse(BaseModel):
    name: str
    country: str
    state: Optional[str] = ""
    lat: float
    lon: float

class WeatherRequest(BaseModel):
    city: str

class CitySearchRequest(BaseModel):
    query: str

class FavoriteCityRequest(BaseModel):
    city_name: str
    user_id: Optional[str] = "default"

class FavoriteCity(BaseModel):
    id: str
    city_name: str
    user_id: str
    created_at: datetime