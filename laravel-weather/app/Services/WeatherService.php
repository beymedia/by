<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;
    protected $geoUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.api_key');
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5';
        $this->geoUrl = 'https://api.openweathermap.org/geo/1.0';
        
        if (!$this->apiKey) {
            throw new \Exception('OpenWeatherMap API key not configured');
        }
    }

    public function getCurrentWeather($city)
    {
        $cacheKey = "current_weather_{$city}";
        
        return Cache::remember($cacheKey, 600, function () use ($city) {
            $response = Http::get("{$this->baseUrl}/weather", [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'az'
            ]);

            if (!$response->successful()) {
                throw new \Exception('Hava məlumatları alınmadı');
            }

            $data = $response->json();
            
            return [
                'city' => $data['name'],
                'country' => $data['sys']['country'],
                'temperature' => round($data['main']['temp']),
                'feels_like' => round($data['main']['feels_like']),
                'description' => ucfirst($data['weather'][0]['description']),
                'humidity' => $data['main']['humidity'],
                'wind_speed' => round($data['wind']['speed'] * 3.6),
                'wind_direction' => $this->getWindDirection($data['wind']['deg'] ?? 0),
                'pressure' => $data['main']['pressure'],
                'visibility' => round(($data['visibility'] ?? 0) / 1000),
                'uv_index' => 0,
                'sunrise' => Carbon::createFromTimestamp($data['sys']['sunrise'])->format('H:i'),
                'sunset' => Carbon::createFromTimestamp($data['sys']['sunset'])->format('H:i'),
                'icon' => $data['weather'][0]['icon'],
                'timestamp' => now()
            ];
        });
    }

    public function getForecast($city)
    {
        $cacheKey = "forecast_{$city}";
        
        return Cache::remember($cacheKey, 1800, function () use ($city) {
            $response = Http::get("{$this->baseUrl}/forecast", [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'az'
            ]);

            if (!$response->successful()) {
                throw new \Exception('Proqnoz məlumatları alınmadı');
            }

            $data = $response->json();
            $dailyForecasts = [];
            
            foreach ($data['list'] as $item) {
                $date = Carbon::createFromTimestamp($item['dt'])->format('Y-m-d');
                $dayName = $this->getDayName(Carbon::createFromTimestamp($item['dt']));
                
                if (!isset($dailyForecasts[$date])) {
                    $dailyForecasts[$date] = [
                        'date' => $dayName,
                        'high' => round($item['main']['temp_max']),
                        'low' => round($item['main']['temp_min']),
                        'description' => ucfirst($item['weather'][0]['description']),
                        'icon' => $item['weather'][0]['icon'],
                        'humidity' => $item['main']['humidity'],
                        'wind_speed' => round($item['wind']['speed'] * 3.6)
                    ];
                } else {
                    $dailyForecasts[$date]['high'] = max($dailyForecasts[$date]['high'], round($item['main']['temp_max']));
                    $dailyForecasts[$date]['low'] = min($dailyForecasts[$date]['low'], round($item['main']['temp_min']));
                }
            }

            return array_slice(array_values($dailyForecasts), 0, 5);
        });
    }

    public function getHourlyForecast($city)
    {
        $cacheKey = "hourly_{$city}";
        
        return Cache::remember($cacheKey, 1800, function () use ($city) {
            $response = Http::get("{$this->baseUrl}/forecast", [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'az'
            ]);

            if (!$response->successful()) {
                throw new \Exception('Saatlıq proqnoz alınmadı');
            }

            $data = $response->json();
            $hourlyData = [];
            
            foreach (array_slice($data['list'], 0, 8) as $item) {
                $time = Carbon::createFromTimestamp($item['dt'])->format('H:i');
                
                $hourlyData[] = [
                    'time' => $time,
                    'temperature' => round($item['main']['temp']),
                    'description' => ucfirst($item['weather'][0]['description']),
                    'icon' => $item['weather'][0]['icon'],
                    'humidity' => $item['main']['humidity'],
                    'wind_speed' => round($item['wind']['speed'] * 3.6)
                ];
            }

            return $hourlyData;
        });
    }

    public function searchCities($query)
    {
        $cacheKey = "search_{$query}";
        
        return Cache::remember($cacheKey, 3600, function () use ($query) {
            $response = Http::get("{$this->geoUrl}/direct", [
                'q' => $query,
                'limit' => 10,
                'appid' => $this->apiKey
            ]);

            if (!$response->successful()) {
                return [];
            }

            $data = $response->json();
            $cities = [];
            
            foreach ($data as $city) {
                $cities[] = [
                    'name' => $city['name'],
                    'country' => $city['country'],
                    'state' => $city['state'] ?? '',
                    'display_name' => $city['name'] . ', ' . $city['country']
                ];
            }

            return $cities;
        });
    }

    private function getWindDirection($degrees)
    {
        $directions = ['S', 'SC', 'C', 'CC', 'Q', 'QC', 'Ş', 'ŞC'];
        $index = round($degrees / 45) % 8;
        return $directions[$index];
    }

    private function getDayName($date)
    {
        $days = [
            'Monday' => 'Bazar ertəsi',
            'Tuesday' => 'Çərşənbə axşamı',
            'Wednesday' => 'Çərşənbə',
            'Thursday' => 'Cümə axşamı',
            'Friday' => 'Cümə',
            'Saturday' => 'Şənbə',
            'Sunday' => 'Bazar'
        ];

        return $days[$date->format('l')] ?? 'Naməlum';
    }
}