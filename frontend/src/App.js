import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { WeatherProvider } from './contexts/WeatherContext';
import WeatherDashboard from './components/WeatherDashboard';
import './App.css';

function App() {
  return (
    <WeatherProvider>
      <Router>
        <div className="App min-h-screen bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500">
          <Routes>
            <Route path="/" element={<WeatherDashboard />} />
          </Routes>
        </div>
      </Router>
    </WeatherProvider>
  );
}

export default App;