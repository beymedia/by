<!-- 5-Day Forecast -->
<div class="space-y-6">
    <h2 class="text-3xl font-bold text-white text-center mb-6">5 Günlük Proqnoz</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
        @foreach($forecast as $index => $day)
            <div class="weather-card rounded-2xl p-6 text-center hover:bg-white/30 transition-all duration-300 hover:scale-105 cursor-pointer">
                <!-- Day -->
                <h3 class="text-lg font-semibold text-white mb-3">
                    {{ $index === 0 ? 'Bu gün' : $day['date'] }}
                </h3>

                <!-- Weather Icon -->
                <div class="text-4xl mb-4">
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
                    {{ $weatherIcons[$day['icon']] ?? '☀️' }}
                </div>

                <!-- Description -->
                <p class="text-white/80 text-sm mb-4">{{ $day['description'] }}</p>

                <!-- Temperature -->
                <div class="mb-4">
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-2xl font-bold text-white">{{ $day['high'] }}°</span>
                        <span class="text-lg text-white/70">{{ $day['low'] }}°</span>
                    </div>
                </div>

                <!-- Weather Details -->
                <div class="space-y-2">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="text-white/80 text-sm">{{ $day['humidity'] }}%</span>
                    </div>
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2M7 4h10l2 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6l2-2z"></path>
                        </svg>
                        <span class="text-white/80 text-sm">{{ $day['wind_speed'] }} km/s</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>