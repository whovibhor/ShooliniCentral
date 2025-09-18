import React, { useMemo, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus } from 'react-icons/fi';
import './dashbaord.css';

const seedTrips = [
    { id: 1, type: 'offer', start: 'Campus Gate', end: 'Solan', time: '6:00 PM', seats: 2, contact: 'wa.me/919876543210' },
    { id: 2, type: 'need', start: 'Admin Block', end: 'Shimla', time: '7:30 AM', seats: 1, contact: '98765 43210' },
    { id: 3, type: 'offer', start: 'Bus Stand', end: 'Dharampur', time: '5:15 PM', seats: 3, contact: 'dm @hostel-A' },
    { id: 4, type: 'offer', start: 'Library', end: 'Kandaghat', time: '8:00 PM', seats: 1, contact: 'tg @lib_ride' },
    { id: 5, type: 'need', start: 'Hostel B', end: 'Kumarhatti', time: '9:15 AM', seats: 1, contact: '70090 77777' },
];

export default function Carpool() {
    const [collapsed, setCollapsed] = useState(false);
    const [trips, setTrips] = useState(seedTrips);
    const [filter, setFilter] = useState('all'); // all | offer | need
    const [query, setQuery] = useState('');
    const [showForm, setShowForm] = useState(false);
    const [form, setForm] = useState({ type: 'offer', start: '', end: '', time: '', seats: 1, contact: '' });
    const [cpFlipped, setCpFlipped] = useState(false);
    const [cpIdx, setCpIdx] = useState(0);

    const filtered = useMemo(() => {
        return trips.filter(t =>
            (filter === 'all' || t.type === filter) &&
            (query.trim() === '' || `${t.start} ${t.end} ${t.time}`.toLowerCase().includes(query.toLowerCase()))
        );
    }, [trips, filter, query]);

    const submitForm = (e) => {
        e.preventDefault();
        if (!form.start.trim() || !form.end.trim() || !form.time.trim() || !form.contact.trim()) return;
        const newTrip = { id: Date.now(), ...form };
        setTrips(prev => [newTrip, ...prev]);
        setForm({ type: 'offer', start: '', end: '', time: '', seats: 1, contact: '' });
        setShowForm(false);
    };

    return (
        <div className="home-dark">
            {/* Top header (brand only) */}
            <header className="topbar">
                <div className="brand">Shoolini Central</div>
                <div className="topbar-spacer" />
                <div className="topbar-actions">
                    <NavLink to="/about" className="hbtn">About</NavLink>
                    <NavLink to="/developer" className="hbtn">Developer</NavLink>
                    <NavLink to="/plans" className="hbtn">Plans</NavLink>
                </div>
            </header>

            <div className={`layout ${collapsed ? 'sidebar-hidden' : ''}`}>
                {/* Floating navigation toggle like Reddit (in the gutter between columns) */}
                <div className="nav-fab" title={collapsed ? 'Expand Navigation' : 'Collapse Navigation'}>
                    <button className="fab-btn" aria-label="Toggle navigation" onClick={() => setCollapsed(!collapsed)}>
                        <span className="fab-bar" />
                        <span className="fab-bar" />
                        <span className="fab-bar" />
                    </button>
                </div>

                {/* Left Sidebar */}
                <aside className={`sidebar ${collapsed ? 'collapsed' : ''}`}>
                    <ul className="navlist">
                        <li><NavLink to="/home" className={({ isActive }) => isActive ? 'active' : ''} title="Home"><span className="icon"><FiHome /></span><span className="hide-when-collapsed">Home</span></NavLink></li>
                        <li><NavLink to="/marketplace" className={({ isActive }) => isActive ? 'active' : ''} title="Marketplace"><span className="icon"><FiShoppingCart /></span><span className="hide-when-collapsed">Marketplace</span></NavLink></li>
                        <li><NavLink to="/carpool" className={({ isActive }) => isActive ? 'active' : ''} title="Carpool"><span className="icon"><FiUsers /></span><span className="hide-when-collapsed">Carpool</span></NavLink></li>
                        <li><NavLink to="/events" className={({ isActive }) => isActive ? 'active' : ''} title="Events & Notices"><span className="icon"><FiCalendar /></span><span className="hide-when-collapsed">Events & Notices</span></NavLink></li>
                        <li><NavLink to="/lostfound" className={({ isActive }) => isActive ? 'active' : ''} title="Lost & Found"><span className="icon"><FiSearch /></span><span className="hide-when-collapsed">Lost & Found</span></NavLink></li>
                        <li><NavLink to="/findmystay" className={({ isActive }) => isActive ? 'active' : ''} title="Find My Stay"><span className="icon"><FiUserCheck /></span><span className="hide-when-collapsed">Find My Stay</span></NavLink></li>
                    </ul>
                </aside>

                {/* Middle Column */}
                <main className="main">
                    <div className="main-inner">
                        <div className="card">
                            <div className="card-head">
                                <h3>Carpool</h3>
                                <button className="post-btn" onClick={() => setShowForm(v => !v)}><FiPlus /> <span>{showForm ? 'Close' : 'Post ride'}</span></button>
                            </div>

                            {/* Filters + Search */}
                            <div className="market-controls">
                                <div className="filters">
                                    {['all', 'offer', 'need'].map((c) => (
                                        <button key={c} className={`pill ${filter === c ? 'active' : ''}`} onClick={() => setFilter(c)}>
                                            {c === 'all' ? 'All' : c === 'offer' ? 'Offering' : 'Needing'}
                                        </button>
                                    ))}
                                </div>
                                <input className="input" placeholder="Search places/time..." value={query} onChange={(e) => setQuery(e.target.value)} />
                            </div>

                            {showForm && (
                                <form className="market-form" onSubmit={submitForm}>
                                    <div className="row">
                                        <div className="col col-sm">
                                            <label>Type</label>
                                            <select className="input" value={form.type} onChange={(e) => setForm({ ...form, type: e.target.value })}>
                                                <option value="offer">Offering seats</option>
                                                <option value="need">Need a ride</option>
                                            </select>
                                        </div>
                                        <div className="col">
                                            <label>Time</label>
                                            <input className="input" placeholder="e.g., 6:00 PM" value={form.time} onChange={(e) => setForm({ ...form, time: e.target.value })} />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col">
                                            <label>From</label>
                                            <input className="input" value={form.start} onChange={(e) => setForm({ ...form, start: e.target.value })} />
                                        </div>
                                        <div className="col">
                                            <label>To</label>
                                            <input className="input" value={form.end} onChange={(e) => setForm({ ...form, end: e.target.value })} />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col col-sm">
                                            <label>Seats</label>
                                            <input type="number" min={1} className="input" value={form.seats} onChange={(e) => setForm({ ...form, seats: Number(e.target.value || 1) })} />
                                        </div>
                                        <div className="col">
                                            <label>Contact</label>
                                            <input className="input" value={form.contact} onChange={(e) => setForm({ ...form, contact: e.target.value })} />
                                        </div>
                                    </div>
                                    <div className="btn-row" style={{ marginTop: 6 }}>
                                        <button type="button" className="secondary" onClick={() => setShowForm(false)}>Cancel</button>
                                        <button type="submit" className="primary">Post Ride</button>
                                    </div>
                                </form>
                            )}

                            {/* List with line visualization + flip details */}
                            <div className={`cp-card ${cpFlipped ? 'is-flipped' : ''}`}>
                                <div className="cp-inner">
                                    <div className="cp-front">
                                        <div className="trip-list">
                                            {filtered.map((t, i) => (
                                                <div className="trip clickable" key={t.id} onClick={() => { setCpIdx(i); setCpFlipped(true); }}>
                                                    <div className="line" />
                                                    <div className="label start">{t.start}</div>
                                                    <div className="time-dot">{t.time}</div>
                                                    <div className="label end">{t.end}</div>
                                                </div>
                                            ))}
                                            {filtered.length === 0 && (
                                                <div className="empty">
                                                    <div className="big">🚗</div>
                                                    <p>No rides found. Try a different filter or time.</p>
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                    <div className="cp-back">
                                        {(() => {
                                            const t = filtered[cpIdx] || filtered[0] || trips[0];
                                            if (!t) return <div className="detail-wrap"><p className="muted">No ride selected.</p></div>;
                                            return (
                                                <div className="detail-wrap">
                                                    <div className="muted" style={{ marginBottom: 8 }}>
                                                        <button className="inline-link" onClick={() => setCpFlipped(false)}>← Back</button>
                                                    </div>
                                                    <h4 className="detail-title">{t.start} → {t.end}</h4>
                                                    <div className="detail-grid">
                                                        <div><span className="dt">Type</span><span className="dd">{t.type === 'offer' ? 'Offering seats' : 'Needs a ride'}</span></div>
                                                        <div><span className="dt">Time</span><span className="dd">{t.time}</span></div>
                                                        <div><span className="dt">Seats</span><span className="dd">{t.seats}</span></div>
                                                        <div><span className="dt">Contact</span><span className="dd">{t.contact}</span></div>
                                                    </div>
                                                    <div className="btn-row">
                                                        <button className="secondary">More</button>
                                                        <button className="primary">Contact</button>
                                                    </div>
                                                </div>
                                            );
                                        })()}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <div className="card-head"><h3>Quick filters</h3></div>
                        <div className="filters">
                            {['offer', 'need'].map((c) => (
                                <button key={c} className="pill" onClick={() => setFilter(c)}>
                                    {c === 'offer' ? 'Offering' : 'Needing'}
                                </button>
                            ))}
                        </div>
                    </div>
                    <div className="card">
                        <div className="card-head"><h3>Safety tips</h3></div>
                        <ul className="mini-list">
                            <li>Meet in public places on campus.</li>
                            <li>Share ride details with a friend.</li>
                            <li>Confirm vehicle and driver before boarding.</li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    );
}
