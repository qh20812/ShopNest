import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { useTranslation } from 'react-i18next';
import { LanguageProvider } from '../contexts/LanguageContext';
import LanguageSwitcher from '../components/Common/LanguageSwitcher';
import Login from '../pages/Auth/login';
import Register from '../pages/Auth/Register';

// Import i18n configuration
import '../i18n';

function App() {
  const { t } = useTranslation('common');

  return (
    <LanguageProvider>
      <Router>
        <div className="App">
          {/* Header with language switcher */}
          <header className="bg-white shadow-sm border-b">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div className="flex justify-between items-center py-4">
                <h1 className="text-2xl font-bold text-gray-900">ShopNest</h1>
                <div className="flex items-center space-x-4">
                  <LanguageSwitcher />
                </div>
              </div>
            </div>
          </header>

          {/* Main content */}
          <main>
            <Routes>
              <Route path="/login" element={<Login />} />
              <Route path="/register" element={<Register />} />
              <Route path="/" element={
                <div className="min-h-screen flex items-center justify-center">
                  <div className="text-center">
                    <h1 className="text-4xl font-bold text-gray-900 mb-4">
                      {t('welcome')}
                    </h1>
                    <div className="space-x-4">
                      <a 
                        href="/login" 
                        className="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700"
                      >
                        Login
                      </a>
                      <a 
                        href="/register" 
                        className="inline-block bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700"
                      >
                        Register
                      </a>
                    </div>
                  </div>
                </div>
              } />
            </Routes>
          </main>
        </div>
      </Router>
    </LanguageProvider>
  );
}

export default App;