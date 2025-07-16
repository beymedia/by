<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hava Proqnozu')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        /* Custom animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .weather-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .hover-scale {
            transition: transform 0.3s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    @yield('content')
    
    <!-- Loading overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="weather-card rounded-2xl p-8 text-center">
            <div class="loading-spinner w-16 h-16 border-4 border-white border-t-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-white text-lg">Hava məlumatları yüklənir...</p>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // CSRF token for AJAX requests
        window.csrf_token = '{{ csrf_token() }}';
        
        // Show loading overlay
        function showLoading() {
            document.getElementById('loading-overlay').classList.remove('hidden');
        }
        
        // Hide loading overlay
        function hideLoading() {
            document.getElementById('loading-overlay').classList.add('hidden');
        }
        
        // AJAX helper function
        async function makeRequest(url, method = 'GET', data = null) {
            showLoading();
            
            try {
                const options = {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrf_token
                    }
                };
                
                if (data) {
                    options.body = JSON.stringify(data);
                }
                
                const response = await fetch(url, options);
                const result = await response.json();
                
                return result;
            } catch (error) {
                console.error('Request failed:', error);
                return { success: false, error: 'Xəta baş verdi' };
            } finally {
                hideLoading();
            }
        }
        
        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500' : 'bg-red-500'
            } text-white`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
</body>
</html>