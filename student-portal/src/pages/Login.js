import React, { useState } from 'react';

export default function Login() {
    const [email, setEmail] = useState('admin@example.com');
    const [password, setPassword] = useState('');
    const [message, setMessage] = useState('');

    async function onSubmit(e) {
        e.preventDefault();
        try {
            const res = await fetch(process.env.REACT_APP_API_BASE_URL + '/admin/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            const data = await res.json();
            if (!res.ok) throw new Error(data?.error?.message || data?.message || 'Login failed');
            localStorage.setItem('token', data.token);
            setMessage('Logged in. Token stored.');
        } catch (err) {
            setMessage(err.message);
        }
    }

    return (
        <div>
            <h2>Admin Login</h2>
            <form onSubmit={onSubmit} style={{ display: 'grid', gap: 8, maxWidth: 320 }}>
                <input type="email" value={email} onChange={e => setEmail(e.target.value)} placeholder="Email" required />
                <input type="password" value={password} onChange={e => setPassword(e.target.value)} placeholder="Password" required />
                <button type="submit">Login</button>
            </form>
            {message && <p>{message}</p>}
        </div>
    );
}
