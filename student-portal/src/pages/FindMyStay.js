import React, { useMemo, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus } from 'react-icons/fi';
import './dashbaord.css';

// Types: roommate-profile (seeking/offer share), room-vacancy
const TYPES = ['all', 'roommates', 'rooms'];
const PREFERENCES = ['any', 'male', 'female', 'non-binary'];
const BUDGETS = ['<3k', '3-5k', '5-8k', '8-12k', '12k+'];

const seedProfiles = [
    { id: 1, type: 'roommates', name: 'Rahul', preference: 'male', budget: '5-8k', location: 'Hostel Area', about: 'CS student, early riser, non-smoker.', contact: '98765 10001' },
    { id: 2, type: 'roommates', name: 'Aisha', preference: 'female', budget: '3-5k', location: 'Near Admin Block', about: 'Friendly, likes quiet evenings. Looking for 1 roommate.', contact: '98765 10002' },
    { id: 3, type: 'rooms', title: '1 Room in 2BHK', preference: 'any', rent: '6k', location: 'Near Mall Road', details: 'Furnished room, shared kitchen. Deposit 6k.', contact: '70090 22222' },
    { id: 4, type: 'rooms', title: 'PG vacancy (Girls)', preference: 'female', rent: '5k', location: 'Kathlighat', details: 'Meals included. 10 min to campus.', contact: 'PG Owner 98111 33333' },
    { id: 5, type: 'roommates', name: 'Kabir', preference: 'male', budget: '8-12k', location: 'Solan City', about: 'Night owl, gamer, can cook maggi like a pro.', contact: '98980 55555' },
    { id: 6, type: 'rooms', title: 'Sunny room in 1BHK', preference: 'any', rent: '3-5k', location: 'Saproon', details: 'Sunny window, near bus stop, no brokers.', contact: 'Owner 99000 12345' },
    { id: 7, type: 'roommates', name: 'Neha', preference: 'female', budget: '5-8k', location: 'Bajhol', about: 'Gym enthusiast, neat and tidy. Early morning classes.', contact: '78380 99999' },
];

export default function FindMyStay() {
    const [collapsed, setCollapsed] = useState(false);
    const [items, setItems] = useState(seedProfiles);
    const [type, setType] = useState('all');
    const [pref, setPref] = useState('any');
    const [budget, setBudget] = useState('');
    const [query, setQuery] = useState('');
    const [showForm, setShowForm] = useState(false);
    const [formType, setFormType] = useState('roommates'); // roommates | rooms
    const [roommateForm, setRoommateForm] = useState({ name: '', preference: 'any', budget: '3-5k', location: '', about: '', contact: '' });
    const [roomForm, setRoomForm] = useState({ title: '', preference: 'any', rent: '5k', location: '', details: '', contact: '' });

    const filtered = useMemo(() => {
        return items.filter((it) =>
            (type === 'all' || it.type === type) &&
            (pref === 'any' || it.preference === pref) &&
            (!budget || (it.budget === budget || it.rent === budget)) &&
            (query.trim() === '' ||
                (it.name && it.name.toLowerCase().includes(query.toLowerCase())) ||
                (it.title && it.title.toLowerCase().includes(query.toLowerCase())) ||
                it.location.toLowerCase().includes(query.toLowerCase()) ||
                (it.about && it.about.toLowerCase().includes(query.toLowerCase())) ||
                (it.details && it.details.toLowerCase().includes(query.toLowerCase()))
            )
        );
    }, [items, type, pref, budget, query]);

    const submitRoommate = (e) => {
        e.preventDefault();
        if (!roommateForm.name.trim() || !roommateForm.location.trim() || !roommateForm.contact.trim()) return;
        const newItem = { id: Date.now(), type: 'roommates', ...roommateForm };
        setItems((prev) => [newItem, ...prev]);
        setFormType('roommates');
        setRoommateForm({ name: '', preference: 'any', budget: '3-5k', location: '', about: '', contact: '' });
        setShowForm(false);
    };

    const submitRoom = (e) => {
        e.preventDefault();
        if (!roomForm.title.trim() || !roomForm.location.trim() || !roomForm.contact.trim()) return;
        const newItem = { id: Date.now(), type: 'rooms', ...roomForm };
        setItems((prev) => [newItem, ...prev]);
        setFormType('rooms');
        setRoomForm({ title: '', preference: 'any', rent: '5k', location: '', details: '', contact: '' });
        setShowForm(false);
    };

    return (
        <div className="home-dark">
            {/* Top header (brand only) */}
            <header className="topbar">
                <div className="brand" title="Home">Shoolini Central</div>
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
                                <h3>Find My Stay</h3>
                                <button className="post-btn" onClick={() => setShowForm((v) => !v)}>
                                    <FiPlus /> <span>{showForm ? 'Close' : 'Post'}</span>
                                </button>
                            </div>

                            {/* Filters + Search */}
                            <div className="market-controls">
                                <div className="filters">
                                    {TYPES.map((t) => (
                                        <button key={t} className={`pill ${type === t ? 'active' : ''}`} onClick={() => setType(t)}>
                                            {t === 'all' ? 'All' : t === 'rooms' ? 'Rooms' : 'Roommates'}
                                        </button>
                                    ))}
                                </div>
                                <div className="filters">
                                    {PREFERENCES.map((p) => (
                                        <button key={p} className={`pill ${pref === p ? 'active' : ''}`} onClick={() => setPref(p)}>
                                            {p === 'any' ? 'Any preference' : p.charAt(0).toUpperCase() + p.slice(1)}
                                        </button>
                                    ))}
                                </div>
                                <div className="filters">
                                    {BUDGETS.map((b) => (
                                        <button key={b} className={`pill ${budget === b ? 'active' : ''}`} onClick={() => setBudget(b === budget ? '' : b)}>
                                            {b}
                                        </button>
                                    ))}
                                </div>
                                <input className="input" placeholder="Search by name, title, or location..." value={query} onChange={(e) => setQuery(e.target.value)} />
                            </div>

                            {showForm && (
                                <div className="market-form">
                                    <div className="filters" style={{ marginBottom: 0 }}>
                                        <button className={`pill ${formType === 'roommates' ? 'active' : ''}`} onClick={() => setFormType('roommates')}>Roommate Profile</button>
                                        <button className={`pill ${formType === 'rooms' ? 'active' : ''}`} onClick={() => setFormType('rooms')}>Room Vacancy</button>
                                    </div>

                                    {formType === 'roommates' ? (
                                        <form onSubmit={submitRoommate}>
                                            <div className="row">
                                                <div className="col">
                                                    <label>Name</label>
                                                    <input className="input" value={roommateForm.name} onChange={(e) => setRoommateForm({ ...roommateForm, name: e.target.value })} required />
                                                </div>
                                                <div className="col col-sm">
                                                    <label>Preference</label>
                                                    <select className="input" value={roommateForm.preference} onChange={(e) => setRoommateForm({ ...roommateForm, preference: e.target.value })}>
                                                        {PREFERENCES.map((p) => (<option key={p} value={p}>{p}</option>))}
                                                    </select>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col col-sm">
                                                    <label>Budget</label>
                                                    <select className="input" value={roommateForm.budget} onChange={(e) => setRoommateForm({ ...roommateForm, budget: e.target.value })}>
                                                        {BUDGETS.map((b) => (<option key={b} value={b}>{b}</option>))}
                                                    </select>
                                                </div>
                                                <div className="col">
                                                    <label>Location preference</label>
                                                    <input className="input" value={roommateForm.location} onChange={(e) => setRoommateForm({ ...roommateForm, location: e.target.value })} required />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col">
                                                    <label>About</label>
                                                    <textarea className="input" rows={3} value={roommateForm.about} onChange={(e) => setRoommateForm({ ...roommateForm, about: e.target.value })} />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col col-sm">
                                                    <label>Contact</label>
                                                    <input className="input" value={roommateForm.contact} onChange={(e) => setRoommateForm({ ...roommateForm, contact: e.target.value })} required />
                                                </div>
                                            </div>
                                            <div className="btn-row" style={{ marginTop: 6 }}>
                                                <button type="button" className="secondary" onClick={() => setShowForm(false)}>Cancel</button>
                                                <button type="submit" className="primary">Post Profile</button>
                                            </div>
                                        </form>
                                    ) : (
                                        <form onSubmit={submitRoom}>
                                            <div className="row">
                                                <div className="col">
                                                    <label>Title</label>
                                                    <input className="input" value={roomForm.title} onChange={(e) => setRoomForm({ ...roomForm, title: e.target.value })} required />
                                                </div>
                                                <div className="col col-sm">
                                                    <label>Preferred roommate</label>
                                                    <select className="input" value={roomForm.preference} onChange={(e) => setRoomForm({ ...roomForm, preference: e.target.value })}>
                                                        {PREFERENCES.map((p) => (<option key={p} value={p}>{p}</option>))}
                                                    </select>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col col-sm">
                                                    <label>Rent</label>
                                                    <select className="input" value={roomForm.rent} onChange={(e) => setRoomForm({ ...roomForm, rent: e.target.value })}>
                                                        {BUDGETS.map((b) => (<option key={b} value={b}>{b}</option>))}
                                                    </select>
                                                </div>
                                                <div className="col">
                                                    <label>Location</label>
                                                    <input className="input" value={roomForm.location} onChange={(e) => setRoomForm({ ...roomForm, location: e.target.value })} required />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col">
                                                    <label>Details</label>
                                                    <textarea className="input" rows={3} value={roomForm.details} onChange={(e) => setRoomForm({ ...roomForm, details: e.target.value })} />
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col col-sm">
                                                    <label>Contact</label>
                                                    <input className="input" value={roomForm.contact} onChange={(e) => setRoomForm({ ...roomForm, contact: e.target.value })} required />
                                                </div>
                                            </div>
                                            <div className="btn-row" style={{ marginTop: 6 }}>
                                                <button type="button" className="secondary" onClick={() => setShowForm(false)}>Cancel</button>
                                                <button type="submit" className="primary">Post Vacancy</button>
                                            </div>
                                        </form>
                                    )}
                                </div>
                            )}

                            {/* List */}
                            {/* playful banner */}
                            <div className="banner" style={{ marginBottom: 8 }}>🏠 Pro tip: The perfect roommate is the one who washes dishes unprompted. We can dream.</div>
                            <div className="market-grid">
                                {filtered.map((it) => (
                                    <article key={it.id} className="market-item card" style={{ gridTemplateRows: 'auto auto' }}>
                                        <div className="market-body">
                                            <div className="market-meta">
                                                <span className="badge">{it.type === 'rooms' ? 'Room' : 'Roommate'}</span>
                                                <span className="badge" style={{ marginLeft: 6 }}>{it.preference}</span>
                                                {it.budget && <span className="badge" style={{ marginLeft: 6 }}>{it.budget}</span>}
                                                {it.rent && <span className="badge" style={{ marginLeft: 6 }}>{it.rent}</span>}
                                            </div>
                                            <h4 className="market-title">{it.name || it.title}</h4>
                                            <p className="market-desc">{it.about || it.details}</p>
                                            <div className="market-contact">Location: <span>{it.location}</span></div>
                                            <div className="market-contact">Contact: <span className="inline-link">{it.contact}</span></div>
                                        </div>
                                    </article>
                                ))}
                                {filtered.length === 0 && (
                                    <div className="empty" style={{ gridColumn: '1 / -1' }}>
                                        <div className="big">🛏️</div>
                                        <p>No results match your filters. Maybe your future roommate is also filtering too hard.</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <div className="card-head"><h3>Tips</h3></div>
                        <ul className="mini-list">
                            <li>Clearly state budget, location, and preferences.</li>
                            <li>Share ideal move-in dates and minimum stay.</li>
                            <li>Meet in person on campus before finalizing.</li>
                        </ul>
                    </div>
                    <div className="card">
                        <div className="card-head"><h3>Quick filters</h3></div>
                        <div className="filters">
                            <button className="pill" onClick={() => setType('roommates')}>Roommates</button>
                            <button className="pill" onClick={() => setType('rooms')}>Rooms</button>
                        </div>
                        <div className="filters">
                            {PREFERENCES.filter(p => p !== 'any').map((p) => (
                                <button key={p} className="pill" onClick={() => setPref(p)}>{p}</button>
                            ))}
                        </div>
                        <div className="filters">
                            {BUDGETS.map((b) => (
                                <button key={b} className="pill" onClick={() => setBudget(b)}>{b}</button>
                            ))}
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    );
}
