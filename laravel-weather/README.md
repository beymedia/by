# Laravel Hava Proqnozu Saytı

## 🌤️ **Xüsusiyyətlər**

### ✅ **Əsas Funksiyalar:**
- **OpenWeatherMap API İnteqrasiyası** - Həqiqi hava məlumatları
- **Hazırkı Hava Vəziyyəti** - Temperatur, nem, külək, təzyiq
- **5 Günlük Proqnoz** - Gələcək günlər üçün tam proqnoz
- **24 Saatlıq Proqnoz** - Saatbaşı hava dəyişikliyi
- **Şəhər Axtarışı** - Dünya üzrə şəhərlər axtarışı
- **Sevimli Şəhərlər** - Sürətli giriş üçün sevimli şəhərlər

### 🎨 **Dizayn:**
- **Müasir UI/UX** - Glassmorphism effektləri
- **Responsive** - Mobil, tablet, desktop
- **Tailwind CSS** - Müasir stil framework
- **Alpine.js** - Reaktiv JavaScript
- **Animasiyalar** - Smooth keçidlər və hover effektləri

### 🔧 **Texniki Xüsusiyyətlər:**
- **Laravel 9** - Müasir PHP framework
- **Blade Templates** - Server-side rendering
- **MySQL Database** - Sevimli şəhərlərin saxlanması
- **Cache System** - Performans optimizasiyası
- **AJAX** - Səhifə yenilənməsi olmadan məlumat yükləmə

## 🚀 **Qurulum Təlimatları**

### 1. **Faylları Serverə Yükləyin**
```bash
/app/laravel-weather/ qovluğunu serverinizə yükləyin
```

### 2. **Composer Dependencies**
```bash
cd /path/to/laravel-weather
composer install
```

### 3. **Verilənlər Bazası**
```sql
CREATE DATABASE weather_app;
```

### 4. **Environment Configuration**
`.env` faylında:
```env
DB_DATABASE=weather_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
OPENWEATHER_API_KEY=9fe290d3d175b4cb1c8739d4a9719f83
```

### 5. **Migration İcra Edin**
```bash
php artisan migrate
```

### 6. **Serveri Başladın**
```bash
php artisan serve
```

## 📁 **Fayl Strukturu**

```
laravel-weather/
├── app/
│   ├── Http/Controllers/
│   │   └── WeatherController.php
│   ├── Services/
│   │   └── WeatherService.php
│   └── Models/
│       └── Favorite.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   └── weather/
│       ├── index.blade.php
│       └── partials/
│           ├── current.blade.php
│           ├── details.blade.php
│           ├── forecast.blade.php
│           ├── hourly.blade.php
│           └── favorites.blade.php
├── routes/
│   └── web.php
└── database/migrations/
    └── create_favorites_table.php
```

## 🌐 **API Endpoints**

### Web Routes:
- `GET /` - Ana səhifə
- `GET /?city={city}` - Müəyyən şəhər üçün hava

### AJAX Routes:
- `GET /api/weather/current` - Hazırkı hava
- `GET /api/weather/forecast` - 5 günlük proqnoz
- `GET /api/weather/hourly` - Saatlıq proqnoz
- `GET /api/weather/search` - Şəhər axtarışı
- `POST /api/favorites` - Sevimli əlavə et
- `GET /api/favorites` - Sevimliləri göstər
- `DELETE /api/favorites` - Sevimli sil

## 🎯 **İstifadə Təlimatları**

### 1. **Şəhər Axtarışı:**
- Axtarış qutusuna şəhər adı yazın
- Açılan siyahıdan şəhər seçin

### 2. **Sevimli Şəhərlər:**
- Şəhər seçdikdən sonra ulduz düyməsini basın
- "Sevimlilər" tabında əlavə edilmiş şəhərləri görün

### 3. **Proqnoz Görmək:**
- "Hazırkı Hava" - Hal-hazırkı məlumatlar
- "5 Günlük" - Gələcək günlər proqnozu
- "Saatlıq" - 24 saatlıq proqnoz

## 🔧 **Personallaşdırma**

### Rəng Dəyişdirmək:
`resources/views/layouts/app.blade.php` faylında CSS-ni dəyişdirin.

### Dil Dəyişdirmək:
Blade şablonlarında mətn məzmununu dəyişdirin.

### Yeni Funksiya Əlavə Etmək:
`WeatherController` və `WeatherService` fayllarını genişləndirin.

## 🛠️ **Troubleshooting**

### API Key Problemi:
```
.env faylında OPENWEATHER_API_KEY düzgün təyin edilib?
```

### Database Xətası:
```
Migration icra edilib?
Database əlaqəsi düzgündür?
```

### Styling Problemləri:
```
Tailwind CSS CDN yüklənir?
Browser cache təmizləndi?
```

## 📱 **Mobil Uyğunluq**

Sayt tamamilə responsive dizayna malikdir:
- **Mobil**: Vertical layout
- **Tablet**: 2-column grid
- **Desktop**: 3+ column grid

## 🔐 **Təhlükəsizlik**

- CSRF protection
- Input validation
- SQL injection prevention
- XSS protection

## 🎉 **Hazırdır!**

Artıq Laravel hava proqnozu saytınız tamamilə hazırdır və istifadə üçün gözdədir!