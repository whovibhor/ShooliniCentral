import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './dashbaord.css';

export default function Admin() {
    const navigate = useNavigate();
    const [user, setUser] = useState(null);
    const [error, setError] = useState('');

    useEffect(() => {
        async function fetchMe() {
            try {
                const token = localStorage.getItem('token');
                if (!token) return setError('No token found');
                const res = await fetch(process.env.REACT_APP_API_BASE_URL + '/me', {
                    headers: { Authorization: `Bearer ${token}` },
                    credentials: 'include',
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data?.message || 'Failed to load admin');
                setUser(data);
            } catch (e) {
                setError(e.message);
            }
        }
        fetchMe();
    }, []);

    async function onLogout() {
        try {
            const token = localStorage.getItem('token');
            await fetch(process.env.REACT_APP_API_BASE_URL + '/admin/logout', {
                method: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                credentials: 'include',
            });
        } finally {
            localStorage.removeItem('token');
            navigate('/admin/login');
        }
    }

    return (
        <div className="page">
            <h2>Admin dashboard</h2>
            {user && (
                <p>Welcome, {user.name} ({user.email})</p>
            )}
            {error && <p style={{ color: 'crimson' }}>{error}</p>}
            <button onClick={onLogout}>Logout</button>
        </div>
    );
}
