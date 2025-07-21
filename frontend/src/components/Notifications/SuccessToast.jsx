import React, { useEffect, useState } from 'react';
import '../../styles/notif-style.css';

function SuccessToast({ message = 'Your action was successful!', duration = 10000, onClose }) {
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
        <div className="notification success-toast show">
            <div className="notification-content">
                <p className="text-sm text-gray-700">{message}</p>
            </div>
        </div>
    );
}

export default SuccessToast;