import React from 'react';
import { useLanguage } from '../../contexts/LanguageContext';

const LanguageSwitcher = () => {
  const { currentLanguage, changeLanguage, getLanguageLabel, availableLanguages } = useLanguage();

  return (
    <div className="relative inline-block text-left">
      <select
        value={currentLanguage}
        onChange={(e) => changeLanguage(e.target.value)}
        className="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
      >
        {availableLanguages.map((lng) => (
          <option key={lng} value={lng}>
            {getLanguageLabel(lng)}
          </option>
        ))}
      </select>
    </div>
  );
};

export default LanguageSwitcher;
