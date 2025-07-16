<!-- Weather Details Card -->
<div class="weather-card rounded-2xl p-6 shadow-xl">
    <h2 class="text-2xl font-bold text-white mb-6 text-center">
        Ətraflı Məlumat
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Feels Like -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="text-white font-semibold">Hiss olunur</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['feels_like'] }}°</span>
            </div>
            <p class="text-white/70 text-sm">Həqiqi temperatur hissi</p>
        </div>

        <!-- Wind Speed -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2M7 4h10l2 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6l2-2z"></path>
                </svg>
                <h3 class="text-white font-semibold">Külək Sürəti</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['wind_speed'] }} km/s</span>
            </div>
            <p class="text-white/70 text-sm">İstiqamət: {{ $weather['wind_direction'] }}</p>
        </div>

        <!-- Humidity -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-white font-semibold">Nem</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['humidity'] }}%</span>
            </div>
            <p class="text-white/70 text-sm">Havadakı nəmlik səviyyəsi</p>
        </div>

        <!-- Pressure -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <h3 class="text-white font-semibold">Atmosfer Təzyiqi</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['pressure'] }} hPa</span>
            </div>
            <p class="text-white/70 text-sm">Hava təzyiqi göstəricisi</p>
        </div>

        <!-- Visibility -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <h3 class="text-white font-semibold">Görmə Məsafəsi</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['visibility'] }} km</span>
            </div>
            <p class="text-white/70 text-sm">Maksimum görmə məsafəsi</p>
        </div>

        <!-- UV Index -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-3 mb-3">
                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-white font-semibold">UV İndeksi</h3>
            </div>
            <div class="mb-2">
                <span class="text-2xl font-bold text-white">{{ $weather['uv_index'] }}</span>
            </div>
            <p class="text-white/70 text-sm">Ultrabənövşəyi şüa səviyyəsi</p>
        </div>
    </div>
</div>