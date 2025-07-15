from fastapi import APIRouter, HTTPException
from typing import List
from services.weather_service import weather_service
from models.weather_models import (
    CurrentWeatherResponse,
    ForecastDayResponse,
    HourlyForecastResponse,
    CitySearchResponse,
    WeatherRequest,
    CitySearchRequest,
    FavoriteCityRequest,
    FavoriteCity
)
from datetime import datetime
import uuid

router = APIRouter()

@router.get("/current/{city}", response_model=CurrentWeatherResponse)
async def get_current_weather(city: str):
    """Get current weather for a city"""
    try:
        weather_data = await weather_service.get_current_weather(city)
        return CurrentWeatherResponse(**weather_data)
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

@router.get("/forecast/{city}", response_model=List[ForecastDayResponse])
async def get_forecast(city: str):
    """Get 5-day forecast for a city"""
    try:
        forecast_data = await weather_service.get_forecast(city)
        return [ForecastDayResponse(**day) for day in forecast_data]
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

@router.get("/hourly/{city}", response_model=List[HourlyForecastResponse])
async def get_hourly_forecast(city: str):
    """Get hourly forecast for a city"""
    try:
        hourly_data = await weather_service.get_hourly_forecast(city)
        return [HourlyForecastResponse(**hour) for hour in hourly_data]
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

@router.get("/search/{query}", response_model=List[CitySearchResponse])
async def search_cities(query: str):
    """Search for cities"""
    try:
        cities = await weather_service.search_cities(query)
        return [CitySearchResponse(**city) for city in cities]
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

# In-memory storage for favorites (in production, use database)
favorites_storage = {}

@router.post("/favorites")
async def add_favorite_city(request: FavoriteCityRequest):
    """Add a city to favorites"""
    try:
        user_id = request.user_id
        if user_id not in favorites_storage:
            favorites_storage[user_id] = []
        
        # Check if city already exists
        existing = next((fav for fav in favorites_storage[user_id] if fav['city_name'] == request.city_name), None)
        if existing:
            return {"message": "Şəhər artıq sevimlilər siyahısındadır"}
        
        favorite = {
            "id": str(uuid.uuid4()),
            "city_name": request.city_name,
            "user_id": user_id,
            "created_at": datetime.utcnow()
        }
        
        favorites_storage[user_id].append(favorite)
        return {"message": "Şəhər sevimlilərə əlavə edildi", "favorite": favorite}
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

@router.get("/favorites/{user_id}")
async def get_favorite_cities(user_id: str = "default"):
    """Get user's favorite cities"""
    try:
        return favorites_storage.get(user_id, [])
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

@router.delete("/favorites/{user_id}/{city_name}")
async def remove_favorite_city(user_id: str, city_name: str):
    """Remove a city from favorites"""
    try:
        if user_id in favorites_storage:
            favorites_storage[user_id] = [
                fav for fav in favorites_storage[user_id] 
                if fav['city_name'] != city_name
            ]
            return {"message": "Şəhər sevimlilərdən silindi"}
        return {"message": "Şəhər tapılmadı"}
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))