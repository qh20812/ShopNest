import React, { useEffect, useState } from 'react';
import '../../styles/notif-style.css';

function ErrorToast({ message = 'An error occurred!', duration = 10000, onClose }) {
    const [show, setShow] = useState(true);

    useEffect(() => {
        if (show) {
            const timer = setTimeout(() => {
                setShow(false);
                if (onClose) onClose();
            }, duration);
            return () => clearTimeout(timer);
        }
    }, [show, duration, onClose]);

    if (!show) return null;

    return (
        <div className="notification error-toast show">
            <div className="notification-content">
                <p className="text-sm text-red-700">{message}</p>
            </div>
        </div>
    );
}

export default ErrorToast;
