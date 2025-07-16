<!-- Favorites -->
<div class="weather-card rounded-2xl p-6 shadow-xl">
    <h2 class="text-3xl font-bold text-white text-center mb-6">
        Sevimli Şəhərlər
    </h2>
    
    <!-- Favorites List -->
    <div x-show="favorites.length > 0">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <template x-for="favorite in favorites" :key="favorite.id">
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105 cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3" @click="selectCity({name: favorite.city_name, display_name: favorite.city_name})">
                            <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-white font-semibold text-lg" x-text="favorite.city_name"></span>
                        </div>
                        
                        <button 
                            @click="removeFavorite(favorite.city_name)"
                            class="text-red-400 hover:text-red-300 hover:bg-red-400/20 p-2 rounded-lg transition-all duration-200"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="mt-3 pt-3 border-t border-white/20">
                        <p class="text-white/70 text-sm text-center">
                            Hava məlumatlarını görmək üçün kliklə
                        </p>
                    </div>
                </div>
            </template>
        </div>
    </div>
    
    <!-- Empty State -->
    <div x-show="favorites.length === 0" class="text-center py-12">
        <svg class="w-16 h-16 text-white/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
        </svg>
        <h2 class="text-2xl font-bold text-white mb-2">Sevimli Şəhər Yoxdur</h2>
        <p class="text-white/80">
            Şəhər axtarışı zamanı ulduz düyməsini basaraq sevimli şəhərlərinizi əlavə edin.
        </p>
    </div>
    
    <!-- Tips -->
    <div class="mt-8 p-4 bg-white/10 backdrop-blur-lg rounded-xl border border-white/20">
        <div class="flex items-center gap-3 text-white/80">
            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </svg>
            <p class="text-sm">
                <span class="font-semibold">Məsləhət:</span> Şəhər axtarışı zamanı ulduz düyməsini basaraq yeni şəhərlər əlavə edə bilərsiniz.
            </p>
        </div>
    </div>
</div>