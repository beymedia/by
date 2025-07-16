@extends('layouts.app')

@section('title', 'Hava Proqnozu - ' . $city)

@section('content')
<div class="min-h-screen p-4" x-data="weatherApp()">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-white mb-4 drop-shadow-lg float-animation">
                🌤️ Hava Proqnozu
            </h1>
            <p class="text-xl text-white/90">Hazırkı hava vəziyyəti və proqnoz</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <div class="weather-card rounded-2xl p-4">
                    <div class="flex gap-3">
                        <div class="flex-1 relative">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-white/70 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input 
                                    type="text" 
                                    x-model="searchQuery"
                                    @input="searchCities"
                                    placeholder="Şəhər adı daxil edin..."
                                    class="w-full pl-10 pr-4 py-3 bg-white/20 backdrop-blur-lg border border-white/30 rounded-xl text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-300"
                                >
                            </div>
                            
                            <!-- Search Suggestions -->
                            <div x-show="suggestions.length > 0" class="absolute top-full mt-2 w-full bg-white/95 backdrop-blur-lg border border-white/30 rounded-xl shadow-xl z-10 max-h-60 overflow-y-auto">
                                <template x-for="city in suggestions" :key="city.name">
                                    <button 
                                        @click="selectCity(city)"
                                        class="w-full px-4 py-3 text-left hover:bg-purple-50 transition-colors duration-200 first:rounded-t-xl last:rounded-b-xl"
                                    >
                                        <div class="flex items-center gap-3">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="text-gray-800" x-text="city.display_name"></span>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>
                        
                        <button 
                            @click="addToFavorites"
                            class="bg-white/20 backdrop-blur-lg border border-white/30 hover:bg-white/30 transition-all duration-300 px-4 py-3 rounded-xl"
                        >
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="mt-3 text-center">
                        <span class="text-white/90 text-sm">
                            Seçilmiş şəhər: <span class="font-semibold" x-text="currentCity"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex justify-center mb-8">
            <div class="glass-effect rounded-2xl p-2">
                <div class="flex gap-2">
                    <button 
                        @click="activeTab = 'current'"
                        :class="activeTab === 'current' ? 'bg-white text-purple-600 shadow-lg transform scale-105' : 'text-white hover:bg-white/20'"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300"
                    >
                        Hazırkı Hava
                    </button>
                    <button 
                        @click="activeTab = 'forecast'"
                        :class="activeTab === 'forecast' ? 'bg-white text-purple-600 shadow-lg transform scale-105' : 'text-white hover:bg-white/20'"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300"
                    >
                        5 Günlük
                    </button>
                    <button 
                        @click="activeTab = 'hourly'"
                        :class="activeTab === 'hourly' ? 'bg-white text-purple-600 shadow-lg transform scale-105' : 'text-white hover:bg-white/20'"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300"
                    >
                        Saatlıq
                    </button>
                    <button 
                        @click="activeTab = 'favorites'"
                        :class="activeTab === 'favorites' ? 'bg-white text-purple-600 shadow-lg transform scale-105' : 'text-white hover:bg-white/20'"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-300"
                    >
                        Sevimlilər
                    </button>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="space-y-6">
            <!-- Current Weather -->
            <div x-show="activeTab === 'current'" class="space-y-6">
                @if($weather)
                    @include('weather.partials.current', ['weather' => $weather])
                    @include('weather.partials.details', ['weather' => $weather])
                @else
                    <div class="weather-card rounded-2xl p-8 text-center">
                        <p class="text-white text-xl">Hava məlumatları yüklənmir</p>
                    </div>
                @endif
            </div>

            <!-- Forecast -->
            <div x-show="activeTab === 'forecast'">
                @if($forecast)
                    @include('weather.partials.forecast', ['forecast' => $forecast])
                @else
                    <div class="weather-card rounded-2xl p-8 text-center">
                        <p class="text-white text-xl">Proqnoz məlumatları yüklənmir</p>
                    </div>
                @endif
            </div>

            <!-- Hourly -->
            <div x-show="activeTab === 'hourly'">
                @if($hourly)
                    @include('weather.partials.hourly', ['hourly' => $hourly])
                @else
                    <div class="weather-card rounded-2xl p-8 text-center">
                        <p class="text-white text-xl">Saatlıq proqnoz yüklənmir</p>
                    </div>
                @endif
            </div>

            <!-- Favorites -->
            <div x-show="activeTab === 'favorites'">
                @include('weather.partials.favorites')
            </div>
        </div>
    </div>
</div>

<script>
function weatherApp() {
    return {
        activeTab: 'current',
        searchQuery: '',
        suggestions: [],
        currentCity: '{{ $city }}',
        favorites: [],
        
        init() {
            this.loadFavorites();
        },
        
        async searchCities() {
            if (this.searchQuery.length < 2) {
                this.suggestions = [];
                return;
            }
            
            try {
                const response = await fetch(`/api/weather/search?query=${encodeURIComponent(this.searchQuery)}`);
                const result = await response.json();
                
                if (result.success) {
                    this.suggestions = result.data;
                }
            } catch (error) {
                console.error('Search failed:', error);
            }
        },
        
        selectCity(city) {
            this.currentCity = city.name;
            this.searchQuery = '';
            this.suggestions = [];
            
            // Reload page with new city
            window.location.href = `/?city=${encodeURIComponent(city.name)}`;
        },
        
        async addToFavorites() {
            try {
                const response = await fetch('/api/favorites', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrf_token
                    },
                    body: JSON.stringify({ city: this.currentCity })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification(result.message, 'success');
                    this.loadFavorites();
                } else {
                    showNotification(result.error, 'error');
                }
            } catch (error) {
                showNotification('Xəta baş verdi', 'error');
            }
        },
        
        async loadFavorites() {
            try {
                const response = await fetch('/api/favorites');
                const result = await response.json();
                
                if (result.success) {
                    this.favorites = result.data;
                }
            } catch (error) {
                console.error('Failed to load favorites:', error);
            }
        },
        
        async removeFavorite(cityName) {
            try {
                const response = await fetch('/api/favorites', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrf_token
                    },
                    body: JSON.stringify({ city: cityName })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification(result.message, 'success');
                    this.loadFavorites();
                } else {
                    showNotification(result.error, 'error');
                }
            } catch (error) {
                showNotification('Xəta baş verdi', 'error');
            }
        }
    }
}
</script>
@endsection