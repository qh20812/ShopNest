import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';
import LanguageDetector from 'i18next-browser-languagedetector';
import Backend from 'i18next-http-backend';

// Import translation files
import enCommon from '../locales/en/common.json';
import enAuth from '../locales/en/auth.json';
import enProduct from '../locales/en/product.json';

import viCommon from '../locales/vi/common.json';
import viAuth from '../locales/vi/auth.json';
import viProduct from '../locales/vi/product.json';

const resources = {
  en: {
    common: enCommon,
    auth: enAuth,
    product: enProduct,
  },
  vi: {
    common: viCommon,
    auth: viAuth,
    product: viProduct,
  },
};

i18n
  // Load translation using http -> see /public/locales (i.e. https://github.com/i18next/react-i18next/tree/master/example/react/public/locales)
  // Learn more: https://github.com/i18next/i18next-http-backend
  .use(Backend)
  // Detect user language
  // Learn more: https://github.com/i18next/i18next-browser-languageDetector
  .use(LanguageDetector)
  // Pass the i18n instance to react-i18next.
  .use(initReactI18next)
  // Initialize i18next
  // For all options read: https://www.i18next.com/overview/configuration-options
  .init({
    resources,
    fallbackLng: 'en',
    debug: process.env.NODE_ENV === 'development',

    interpolation: {
      escapeValue: false, // Not needed for react as it escapes by default
    },

    // Language detection options
    detection: {
      order: ['localStorage', 'navigator', 'htmlTag'],
      caches: ['localStorage'],
    },

    // Default namespace
    defaultNS: 'common',
    ns: ['common', 'auth', 'product'],
  });

export default i18n;
