import React, { useMemo, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck } from 'react-icons/fi';
import './dashbaord.css';

const today = new Date();
function getMonthMatrix(date = new Date()) {
    const y = date.getFullYear();
    const m = date.getMonth();
    const first = new Date(y, m, 1);
    const start = new Date(y, m, 1 - ((first.getDay() + 6) % 7)); // week starts Mon
    const weeks = [];
    for (let w = 0; w < 6; w++) {
        const row = [];
        for (let d = 0; d < 7; d++) {
            const day = new Date(start);
            day.setDate(start.getDate() + w * 7 + d);
            row.push(day);
        }
        weeks.push(row);
    }
    return weeks;
}

const seedEvents = [
    { id: 1, date: new Date(today.getFullYear(), today.getMonth(), today.getDate()), title: 'Club Orientation', where: 'Auditorium', time: '4:00 PM' },
    { id: 2, date: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 2), title: 'Hackathon', where: 'Lab 2', time: '10:00 AM' },
    { id: 3, date: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 3), title: 'Guest Lecture: AI in 2025', where: 'Seminar Hall', time: '2:30 PM' },
    { id: 4, date: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5), title: 'Blood Donation Camp', where: 'Medical Center', time: '11:00 AM' },
    { id: 5, date: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 7), title: 'Cultural Night', where: 'Open Grounds', time: '6:00 PM' },
];

export default function Events() {
    const [collapsed, setCollapsed] = useState(false);
    const [month, setMonth] = useState(new Date());
    const [events] = useState(seedEvents);
    const monthMatrix = useMemo(() => getMonthMatrix(month), [month]);
    const byDate = useMemo(() => {
        const map = new Map();
        for (const e of events) {
            const key = e.date.toDateString();
            map.set(key, [...(map.get(key) || []), e]);
        }
        return map;
    }, [events]);

    const isSameDay = (a, b) => a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate();

    const upcoming = useMemo(() =>
        events
            .filter(e => e.date >= today)
            .sort((a, b) => a.date - b.date)
            .slice(0, 5),
        [events]
    );

    const prevMonth = () => setMonth(new Date(month.getFullYear(), month.getMonth() - 1, 1));
    const nextMonth = () => setMonth(new Date(month.getFullYear(), month.getMonth() + 1, 1));

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
                {/* Floating navigation toggle like Reddit */}
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
                                <h3>Events & Notices</h3>
                            </div>
                            <div className="filters" style={{ marginBottom: 6 }}>
                                <button className="pill">Today</button>
                                <button className="pill">This Week</button>
                                <button className="pill">All</button>
                            </div>
                            <ul className="event-list">
                                {events
                                    .slice()
                                    .sort((a, b) => a.date - b.date)
                                    .map((e) => (
                                        <li key={e.id} className="event-item clickable">
                                            <div className="event-date">
                                                <div className="event-day">{e.date.getDate()}</div>
                                                <div className="event-mon">{e.date.toLocaleString('default', { month: 'short' })}</div>
                                            </div>
                                            <div className="event-text">
                                                <div className="event-title">{e.title}</div>
                                                <div className="event-meta">{e.time || ''} {e.time ? '· ' : ''}{e.where}</div>
                                            </div>
                                        </li>
                                    ))}
                            </ul>
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <div className="card-head" style={{ justifyContent: 'space-between' }}>
                            <h3 style={{ margin: 0 }}>{month.toLocaleString('default', { month: 'long' })} {month.getFullYear()}</h3>
                            <div style={{ marginLeft: 'auto', display: 'flex', gap: 6 }}>
                                <button className="secondary" onClick={prevMonth}>Prev</button>
                                <button className="secondary" onClick={nextMonth}>Next</button>
                            </div>
                        </div>
                        <div className="cal-grid">
                            {['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'].map((d) => (
                                <div key={d} className="cal-h">{d}</div>
                            ))}
                            {monthMatrix.flat().map((d, idx) => {
                                const otherMonth = d.getMonth() !== month.getMonth();
                                const key = d.toDateString();
                                const has = byDate.get(key);
                                return (
                                    <div key={idx} className={`cal-day ${otherMonth ? 'cal--other' : ''} ${isSameDay(d, today) ? 'cal--today' : ''}`}>
                                        <div className="cal-date">{d.getDate()}</div>
                                        {has && <div className="cal-dot" />}
                                        {/* Hover preview */}
                                        {has && (
                                            <div className="cal-pop">
                                                {has.slice(0, 3).map((e) => (
                                                    <div key={e.id} className="cal-pop-row">
                                                        <div className="cal-pop-title">{e.title}</div>
                                                        <div className="cal-pop-meta">{e.time || ''} {e.time ? '· ' : ''}{e.where}</div>
                                                    </div>
                                                ))}
                                                {has.length > 3 && <div className="cal-pop-more">+{has.length - 3} more…</div>}
                                            </div>
                                        )}
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                    <div className="card">
                        <div className="card-head"><h3>Upcoming</h3></div>
                        <ul className="mini-list">
                            {upcoming.map((e) => (
                                <li key={e.id}>
                                    <span className="badge">{e.date.toLocaleDateString()}</span>
                                    <span>{e.title} — <span className="muted">{e.where}</span></span>
                                </li>
                            ))}
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    );
}
