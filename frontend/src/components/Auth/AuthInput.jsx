
import React from 'react';
import { useTranslation } from 'react-i18next';

function AuthInput({ type = 'text', placeholder, name, value, onChange, required = false, namespace = 'auth' }) {
    const { t } = useTranslation(namespace);
    
    return (
        <div className="w-full mb-4">
            <input
                type={type}
                name={name}
                value={value}
                onChange={onChange}
                placeholder={t(placeholder) || placeholder}
                required={required}
                className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 text-gray-700 bg-white shadow-sm"
            />
        </div>
    );
}

export default AuthInput;