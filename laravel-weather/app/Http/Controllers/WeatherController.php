<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $city = $request->get('city', 'Bakı');
        $weather = null;
        $forecast = null;
        $hourly = null;
        $error = null;

        try {
            $weather = $this->weatherService->getCurrentWeather($city);
            $forecast = $this->weatherService->getForecast($city);
            $hourly = $this->weatherService->getHourlyForecast($city);
        } catch (\Exception $e) {
            $error = 'Hava məlumatları alınmadı: ' . $e->getMessage();
        }

        return view('weather.index', compact('weather', 'forecast', 'hourly', 'error', 'city'));
    }

    public function getCurrentWeather(Request $request)
    {
        $city = $request->get('city', 'Bakı');
        
        try {
            $weather = $this->weatherService->getCurrentWeather($city);
            return response()->json(['success' => true, 'data' => $weather]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function getForecast(Request $request)
    {
        $city = $request->get('city', 'Bakı');
        
        try {
            $forecast = $this->weatherService->getForecast($city);
            return response()->json(['success' => true, 'data' => $forecast]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function getHourlyForecast(Request $request)
    {
        $city = $request->get('city', 'Bakı');
        
        try {
            $hourly = $this->weatherService->getHourlyForecast($city);
            return response()->json(['success' => true, 'data' => $hourly]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function searchCities(Request $request)
    {
        $query = $request->get('query', '');
        
        if (strlen($query) < 2) {
            return response()->json(['success' => true, 'data' => []]);
        }

        try {
            $cities = $this->weatherService->searchCities($query);
            return response()->json(['success' => true, 'data' => $cities]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    public function addFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $userId = $request->session()->get('user_id', 'guest');
        $city = $request->city;

        // Check if already exists
        $existing = Favorite::where('user_id', $userId)
                           ->where('city_name', $city)
                           ->first();

        if ($existing) {
            return response()->json(['success' => false, 'error' => 'Şəhər artıq sevimlilər siyahısındadır']);
        }

        Favorite::create([
            'user_id' => $userId,
            'city_name' => $city
        ]);

        return response()->json(['success' => true, 'message' => 'Şəhər sevimlilərə əlavə edildi']);
    }

    public function getFavorites(Request $request)
    {
        $userId = $request->session()->get('user_id', 'guest');
        
        $favorites = Favorite::where('user_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json(['success' => true, 'data' => $favorites]);
    }

    public function removeFavorite(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255'
        ]);

        $userId = $request->session()->get('user_id', 'guest');
        $city = $request->city;

        Favorite::where('user_id', $userId)
                ->where('city_name', $city)
                ->delete();

        return response()->json(['success' => true, 'message' => 'Şəhər sevimlilərdən silindi']);
    }
}