import React from 'react';
import { Card } from './ui/card';

const LoadingSpinner = () => {
  return (
    <div className="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500">
      <Card className="bg-white/20 backdrop-blur-lg border-white/30 shadow-xl">
        <div className="p-12 text-center">
          <div className="relative">
            {/* Loading animation */}
            <div className="w-16 h-16 mx-auto mb-6">
              <div className="absolute inset-0 border-4 border-white/30 rounded-full"></div>
              <div className="absolute inset-0 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
            </div>
            
            {/* Weather icons animation */}
            <div className="flex justify-center gap-4 mb-6">
              <div className="text-3xl animate-bounce" style={{ animationDelay: '0s' }}>☀️</div>
              <div className="text-3xl animate-bounce" style={{ animationDelay: '0.2s' }}>⛅</div>
              <div className="text-3xl animate-bounce" style={{ animationDelay: '0.4s' }}>🌧️</div>
            </div>
            
            <h2 className="text-2xl font-bold text-white mb-2">Hava Məlumatları Yüklənir</h2>
            <p className="text-white/80">Xahiş olunur gözləyin...</p>
          </div>
        </div>
      </Card>
    </div>
  );
};

export default LoadingSpinner;