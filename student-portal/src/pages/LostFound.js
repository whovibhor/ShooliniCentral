import React, { useMemo, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus } from 'react-icons/fi';
import './dashbaord.css';

const CATEGORIES = ['all', 'id', 'electronics', 'clothing', 'books', 'accessories', 'others'];

const seedItems = [
    { id: 1, status: 'found', title: 'Blue water bottle', category: 'accessories', location: 'Library foyer', time: '2h ago', contact: '98765 43210', desc: 'Stainless bottle with Shoolini sticker.' },
    { id: 2, status: 'lost', title: 'Black wallet', category: 'accessories', location: 'Cafeteria', time: 'Today 3:10 PM', contact: '—', desc: 'Black leather wallet; has student ID and a couple of receipts.' },
    { id: 3, status: 'found', title: 'USB drive (16GB)', category: 'electronics', location: 'Lab 3', time: 'Yesterday', contact: 'Lab Assistant', desc: 'SanDisk with keyring attached. Likely CS batch.' },
    { id: 4, status: 'lost', title: 'ID Card — Ananya', category: 'id', location: 'Hostel A', time: 'Yesterday 9 PM', contact: '70090 12345', desc: 'Red lanyard; Name: Ananya Sharma; Dept: CSA' },
    { id: 5, status: 'found', title: 'Maths notebook', category: 'books', location: 'Seminar Hall', time: '30m ago', contact: '—', desc: 'Blue cover, doodles of integrals inside.' },
    { id: 6, status: 'lost', title: 'Earbuds case', category: 'electronics', location: 'Gym', time: 'Last night', contact: '98989 12121', desc: 'Black case, probably lonely without its earbuds.' },
];

export default function LostFound() {
    const [collapsed, setCollapsed] = useState(false);
    const [items, setItems] = useState(seedItems);
    const [statusFilter, setStatusFilter] = useState('all'); // all | lost | found
    const [catFilter, setCatFilter] = useState('all');
    const [query, setQuery] = useState('');
    const [showForm, setShowForm] = useState(false);
    const [form, setForm] = useState({ status: 'lost', title: '', category: 'id', location: '', desc: '', contact: '' });
    const [selectedId, setSelectedId] = useState(null);

    const filtered = useMemo(() => {
        return items.filter((it) =>
            (statusFilter === 'all' || it.status === statusFilter) &&
            (catFilter === 'all' || it.category === catFilter) &&
            (query.trim() === '' || it.title.toLowerCase().includes(query.toLowerCase()) || it.location.toLowerCase().includes(query.toLowerCase()) || it.desc.toLowerCase().includes(query.toLowerCase()))
        );
    }, [items, statusFilter, catFilter, query]);

    const submitForm = (e) => {
        e.preventDefault();
        if (!form.title.trim() || !form.location.trim() || !form.contact.trim()) return;
        const newItem = {
            id: Date.now(),
            ...form,
            time: 'Just now',
        };
        setItems((prev) => [newItem, ...prev]);
        setForm({ status: 'lost', title: '', category: 'id', location: '', desc: '', contact: '' });
        setShowForm(false);
        setSelectedId(newItem.id);
    };

    const selected = items.find((x) => x.id === selectedId) || null;

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
                                <h3>Lost &amp; Found</h3>
                                <button className="post-btn" onClick={() => setShowForm((v) => !v)}>
                                    <FiPlus /> <span>{showForm ? 'Close' : 'Report item'}</span>
                                </button>
                            </div>

                            {/* Filters + Search */}
                            <div className="market-controls">
                                <div className="filters">
                                    {['all', 'lost', 'found'].map((s) => (
                                        <button key={s} className={`pill ${statusFilter === s ? 'active' : ''}`} onClick={() => setStatusFilter(s)}>
                                            {s === 'all' ? 'All' : s.charAt(0).toUpperCase() + s.slice(1)}
                                        </button>
                                    ))}
                                </div>
                                <div className="filters">
                                    {CATEGORIES.map((c) => (
                                        <button key={c} className={`pill ${catFilter === c ? 'active' : ''}`} onClick={() => setCatFilter(c)}>
                                            {c === 'all' ? 'All categories' : c.charAt(0).toUpperCase() + c.slice(1)}
                                        </button>
                                    ))}
                                </div>
                                <input className="input" placeholder="Search items or locations..." value={query} onChange={(e) => setQuery(e.target.value)} />
                            </div>

                            {showForm && (
                                <form className="market-form" onSubmit={submitForm}>
                                    <div className="row">
                                        <div className="col col-sm">
                                            <label>Status</label>
                                            <select className="input" value={form.status} onChange={(e) => setForm({ ...form, status: e.target.value })}>
                                                <option value="lost">Lost</option>
                                                <option value="found">Found</option>
                                            </select>
                                        </div>
                                        <div className="col">
                                            <label>Title</label>
                                            <input className="input" value={form.title} onChange={(e) => setForm({ ...form, title: e.target.value })} required />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col col-sm">
                                            <label>Category</label>
                                            <select className="input" value={form.category} onChange={(e) => setForm({ ...form, category: e.target.value })}>
                                                {CATEGORIES.filter(c => c !== 'all').map((c) => (
                                                    <option key={c} value={c}>{c.charAt(0).toUpperCase() + c.slice(1)}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div className="col">
                                            <label>Location</label>
                                            <input className="input" value={form.location} onChange={(e) => setForm({ ...form, location: e.target.value })} required />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col">
                                            <label>Description</label>
                                            <textarea className="input" rows={3} value={form.desc} onChange={(e) => setForm({ ...form, desc: e.target.value })} />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col col-sm">
                                            <label>Contact</label>
                                            <input className="input" value={form.contact} onChange={(e) => setForm({ ...form, contact: e.target.value })} required />
                                        </div>
                                    </div>
                                    <div className="btn-row" style={{ marginTop: 6 }}>
                                        <button type="button" className="secondary" onClick={() => setShowForm(false)}>Cancel</button>
                                        <button type="submit" className="primary">Submit</button>
                                    </div>
                                </form>
                            )}

                            {/* Light-hearted banner */}
                            <div className="banner" style={{ marginBottom: 8 }}>🧭 Lost something? Don’t panic. 90% chance it’s plotting its return.</div>
                            {/* List */}
                            <ul className="mini-list" style={{ marginTop: 8 }}>
                                {filtered.map((it) => (
                                    <li key={it.id} className="clickable lf-item" onClick={() => setSelectedId(it.id)}>
                                        <span className={`badge ${it.status}`}>{it.status.charAt(0).toUpperCase() + it.status.slice(1)}</span>
                                        <div className="lf-text">
                                            <div className="lf-title">{it.title}</div>
                                            <div className="lf-meta">{it.location} · {it.time}</div>
                                        </div>
                                        <span style={{ marginLeft: 'auto' }} className="inline-link">{it.contact}</span>
                                    </li>
                                ))}
                            </ul>
                            {filtered.length === 0 && (
                                <div className="empty">
                                    <div className="big">🔍</div>
                                    <p>No matching items. Try adjusting filters or search.</p>
                                </div>
                            )}

                            {selected && (
                                <div className="card" style={{ marginTop: 12 }}>
                                    <div className="muted" style={{ marginBottom: 6 }}>
                                        <button className="inline-link" onClick={() => setSelectedId(null)}>← Back to list</button>
                                    </div>
                                    <h4 className="detail-title">{selected.title}</h4>
                                    <div className="detail-grid">
                                        <div><span className="dt">Status</span><span className="dd">{selected.status}</span></div>
                                        <div><span className="dt">Category</span><span className="dd">{selected.category}</span></div>
                                        <div><span className="dt">Location</span><span className="dd">{selected.location}</span></div>
                                        <div><span className="dt">Reported</span><span className="dd">{selected.time}</span></div>
                                        <div><span className="dt">Contact</span><span className="dd">{selected.contact}</span></div>
                                    </div>
                                    {selected.desc && <p style={{ marginTop: 8 }} className="muted">{selected.desc}</p>}
                                    <div className="btn-row" style={{ marginTop: 6 }}>
                                        <button className="secondary" onClick={() => setSelectedId(null)}>Close</button>
                                        <button className="primary">Mark as Resolved</button>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <div className="card-head"><h3>Tips</h3></div>
                        <ul className="mini-list">
                            <li>Share precise pickup/last-seen locations.</li>
                            <li>Describe unique identifiers (stickers, marks).</li>
                            <li>Meet in public campus spots when exchanging.</li>
                        </ul>
                    </div>
                    <div className="card">
                        <div className="card-head"><h3>Quick filter</h3></div>
                        <div className="filters">
                            {['lost', 'found'].map((s) => (
                                <button key={s} className="pill" onClick={() => setStatusFilter(s)}>
                                    {s.charAt(0).toUpperCase() + s.slice(1)}
                                </button>
                            ))}
                        </div>
                        <div className="filters">
                            {CATEGORIES.filter(c => c !== 'all').map((c) => (
                                <button key={c} className="pill" onClick={() => setCatFilter(c)}>
                                    {c.charAt(0).toUpperCase() + c.slice(1)}
                                </button>
                            ))}
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    );
}
