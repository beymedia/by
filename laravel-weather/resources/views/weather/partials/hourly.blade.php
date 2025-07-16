<!-- Hourly Forecast -->
<div class="weather-card rounded-2xl p-6 shadow-xl">
    <h2 class="text-3xl font-bold text-white text-center mb-6">24 Saatlıq Proqnoz</h2>
    
    <div class="max-h-96 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($hourly as $hour)
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">
                    <!-- Time -->
                    <div class="text-center mb-3">
                        <h3 class="text-lg font-semibold text-white">{{ $hour['time'] }}</h3>
                    </div>

                    <!-- Weather Icon and Temperature -->
                    <div class="flex items-center justify-center gap-4 mb-3">
                        <div class="text-3xl">
                            @php
                                $weatherIcons = [
                                    '01d' => '☀️', '01n' => '🌙',
                                    '02d' => '⛅', '02n' => '⛅',
                                    '03d' => '☁️', '03n' => '☁️',
                                    '04d' => '☁️', '04n' => '☁️',
                                    '09d' => '🌧️', '09n' => '🌧️',
                                    '10d' => '🌦️', '10n' => '🌦️',
                                    '11d' => '⛈️', '11n' => '⛈️',
                                    '13d' => '❄️', '13n' => '❄️',
                                    '50d' => '🌫️', '50n' => '🌫️'
                                ];
                            @endphp
                            {{ $weatherIcons[$hour['icon']] ?? '☀️' }}
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="text-xl font-bold text-white">{{ $hour['temperature'] }}°</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-white/80 text-sm text-center mb-3">{{ $hour['description'] }}</p>

                    <!-- Weather Details -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span class="text-white/80 text-sm">Nem</span>
                            </div>
                            <span class="text-white text-sm font-medium">{{ $hour['humidity'] }}%</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2M7 4h10l2 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6l2-2z"></path>
                                </svg>
                                <span class="text-white/80 text-sm">Külək</span>
                            </div>
                            <span class="text-white text-sm font-medium">{{ $hour['wind_speed'] }} km/s</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>