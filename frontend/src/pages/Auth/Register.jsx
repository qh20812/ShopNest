import React, { useState } from 'react';
import { useTranslation } from 'react-i18next';
import AuthInput from '../../components/Auth/AuthInput';

const Register = () => {
  const { t } = useTranslation('auth');
  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    email: '',
    password: '',
    confirmPassword: '',
    phoneNumber: '',
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle register logic here
    console.log('Register data:', formData);
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-md w-full space-y-8">
        <div>
          <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
            {t('register')}
          </h2>
        </div>
        <form className="mt-8 space-y-6" onSubmit={handleSubmit}>
          <div className="space-y-4">
            <div className="grid grid-cols-2 gap-4">
              <AuthInput
                type="text"
                name="firstName"
                placeholder="firstName"
                value={formData.firstName}
                onChange={handleChange}
                required
              />
              <AuthInput
                type="text"
                name="lastName"
                placeholder="lastName"
                value={formData.lastName}
                onChange={handleChange}
                required
              />
            </div>
            <AuthInput
              type="email"
              name="email"
              placeholder="email"
              value={formData.email}
              onChange={handleChange}
              required
            />
            <AuthInput
              type="tel"
              name="phoneNumber"
              placeholder="phoneNumber"
              value={formData.phoneNumber}
              onChange={handleChange}
            />
            <AuthInput
              type="password"
              name="password"
              placeholder="password"
              value={formData.password}
              onChange={handleChange}
              required
            />
            <AuthInput
              type="password"
              name="confirmPassword"
              placeholder="confirmPassword"
              value={formData.confirmPassword}
              onChange={handleChange}
              required
            />
          </div>

          <div>
            <button
              type="submit"
              className="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
              {t('register')}
            </button>
          </div>

          <div className="text-center">
            <span className="text-sm text-gray-600">
              {t('alreadyHaveAccount')}{' '}
              <a href="/login" className="font-medium text-blue-600 hover:text-blue-500">
                {t('login')}
              </a>
            </span>
          </div>
        </form>
      </div>
    </div>
  );
};

export default Register;
