<!-- Current Weather Card -->
<div class="weather-card rounded-2xl p-8 shadow-xl">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">
                {{ $weather['city'] }}, {{ $weather['country'] }}
            </h2>
            <p class="text-white/80 text-lg">{{ $weather['description'] }}</p>
        </div>
        <div class="text-6xl">
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
            {{ $weatherIcons[$weather['icon']] ?? '☀️' }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Temperature -->
        <div class="text-center">
            <div class="flex items-center justify-center gap-2 mb-2">
                <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-white/80 text-lg">Temperatur</span>
            </div>
            <div class="text-6xl font-bold text-white mb-2">
                {{ $weather['temperature'] }}°
            </div>
            <p class="text-white/70">
                Hiss olunur: {{ $weather['feels_like'] }}°
            </p>
        </div>

        <!-- Weather Stats -->
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2M7 4h10l2 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6l2-2z"></path>
                </svg>
                <span class="text-white/80">Külək:</span>
                <span class="text-white font-semibold">
                    {{ $weather['wind_speed'] }} km/s {{ $weather['wind_direction'] }}
                </span>
            </div>

            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-white/80">Nem:</span>
                <span class="text-white font-semibold">{{ $weather['humidity'] }}%</span>
            </div>

            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="text-white/80">Təzyiq:</span>
                <span class="text-white font-semibold">{{ $weather['pressure'] }} hPa</span>
            </div>

            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <span class="text-white/80">Görmə məsafəsi:</span>
                <span class="text-white font-semibold">{{ $weather['visibility'] }} km</span>
            </div>
        </div>
    </div>

    <!-- Sun Info -->
    <div class="mt-8 pt-6 border-t border-white/20">
        <div class="flex items-center justify-center gap-8">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="text-white/80">Gündoğan:</span>
                <span class="text-white font-semibold">{{ $weather['sunrise'] }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <span class="text-white/80">Günbatan:</span>
                <span class="text-white font-semibold">{{ $weather['sunset'] }}</span>
            </div>
        </div>
    </div>
</div>