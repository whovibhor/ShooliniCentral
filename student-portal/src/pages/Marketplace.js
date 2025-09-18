import React, { useMemo, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus } from 'react-icons/fi';
import './dashbaord.css';

const CATEGORIES = ['all', 'notes', 'books', 'electronics', 'essentials', 'services'];

const seedItems = [
    { id: 1, title: 'ECE Sem-3 Notes (Digital Logic)', category: 'notes', desc: 'Handwritten notes, neat and exam-focused. PDF available.', contact: 'wa.me/919876543210', image: 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=800&auto=format&fit=crop&q=60' },
    { id: 2, title: 'Used Scientific Calculator', category: 'electronics', desc: 'Casio FX-991ES Plus. Good condition.', contact: '98765 43210', image: 'https://images.unsplash.com/photo-1581089781785-603411fa81e5?w=800&auto=format&fit=crop&q=60' },
    { id: 3, title: 'First-Year Engineering Books Set', category: 'books', desc: 'Physics, Chemistry, Maths. Barely used.', contact: 'dm @hostel-A', image: 'https://images.unsplash.com/photo-1519681393784-d120267933ba?w=800&auto=format&fit=crop&q=60' },
    { id: 4, title: 'Room Heater (220V)', category: 'essentials', desc: 'Perfect for winter hostels. Pickup near Admin Block.', contact: '70090 12345', image: 'https://images.unsplash.com/photo-1519996529931-28324d5a630e?w=800&auto=format&fit=crop&q=60' },
    { id: 5, title: 'Printouts / Xerox Service', category: 'services', desc: 'Fast, cheap printouts near Library. Bulk discounts.', contact: 'tg @printbuddy', image: 'https://images.unsplash.com/photo-1585079542156-2755d9c8affd?w=800&auto=format&fit=crop&q=60' },
    { id: 6, title: 'Desk Lamp LED', category: 'electronics', desc: 'Dimmable lamp, perfect for late-night study marathons.', contact: '98100 22222', image: 'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?w=800&auto=format&fit=crop&q=60' },
    { id: 7, title: 'Hostel Kettle', category: 'essentials', desc: 'Tea. Coffee. Maggi. Say no more.', contact: 'wa.me/911234567890', image: 'https://images.unsplash.com/photo-1541167760496-1628856ab772?w=800&auto=format&fit=crop&q=60' },
];

export default function Marketplace() {
    const [collapsed, setCollapsed] = useState(false);
    const [items, setItems] = useState(seedItems);
    const [filter, setFilter] = useState('all');
    const [query, setQuery] = useState('');
    const [showForm, setShowForm] = useState(false);
    const [form, setForm] = useState({ title: '', category: 'notes', desc: '', contact: '', image: '' });

    const filtered = useMemo(() => {
        return items.filter((it) =>
            (filter === 'all' || it.category === filter) &&
            (query.trim() === '' || it.title.toLowerCase().includes(query.toLowerCase()) || it.desc.toLowerCase().includes(query.toLowerCase()))
        );
    }, [items, filter, query]);

    const submitForm = (e) => {
        e.preventDefault();
        if (!form.title.trim() || !form.contact.trim()) return;
        const newItem = {
            id: Date.now(),
            ...form,
            image: form.image || 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&auto=format&fit=crop&q=60',
        };
        setItems((prev) => [newItem, ...prev]);
        setForm({ title: '', category: 'notes', desc: '', contact: '', image: '' });
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
                                <h3>Marketplace</h3>
                                <button className="post-btn" onClick={() => setShowForm((v) => !v)}>
                                    <FiPlus /> <span>{showForm ? 'Close' : 'List item'}</span>
                                </button>
                            </div>

                            {/* Filters + Search */}
                            <div className="market-controls">
                                <div className="filters">
                                    {CATEGORIES.map((c) => (
                                        <button key={c} className={`pill ${filter === c ? 'active' : ''}`} onClick={() => setFilter(c)}>
                                            {c === 'all' ? 'All' : c.charAt(0).toUpperCase() + c.slice(1)}
                                        </button>
                                    ))}
                                </div>
                                <input className="input" placeholder="Search items..." value={query} onChange={(e) => setQuery(e.target.value)} />
                            </div>

                            {showForm && (
                                <form className="market-form" onSubmit={submitForm}>
                                    <div className="row">
                                        <div className="col">
                                            <label>Title</label>
                                            <input className="input" value={form.title} onChange={(e) => setForm({ ...form, title: e.target.value })} required />
                                        </div>
                                        <div className="col col-sm">
                                            <label>Category</label>
                                            <select className="input" value={form.category} onChange={(e) => setForm({ ...form, category: e.target.value })}>
                                                {CATEGORIES.filter(c => c !== 'all').map((c) => (
                                                    <option key={c} value={c}>{c.charAt(0).toUpperCase() + c.slice(1)}</option>
                                                ))}
                                            </select>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col">
                                            <label>Description</label>
                                            <textarea className="input" rows={3} value={form.desc} onChange={(e) => setForm({ ...form, desc: e.target.value })} />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col">
                                            <label>Image URL (optional)</label>
                                            <input className="input" value={form.image} onChange={(e) => setForm({ ...form, image: e.target.value })} />
                                        </div>
                                        <div className="col col-sm">
                                            <label>Contact</label>
                                            <input className="input" value={form.contact} onChange={(e) => setForm({ ...form, contact: e.target.value })} required />
                                        </div>
                                    </div>
                                    <div className="btn-row" style={{ marginTop: 6 }}>
                                        <button type="button" className="secondary" onClick={() => setShowForm(false)}>Cancel</button>
                                        <button type="submit" className="primary">Post Item</button>
                                    </div>
                                </form>
                            )}

                            {/* Playful banner */}
                            <div className="banner" style={{ marginBottom: 8 }}>🛒 Buyer tip: If it’s a calculator, ask if it knows your exam answers. Can’t hurt.</div>
                            {/* Grid */}
                            <div className="market-grid">
                                {filtered.map((it) => (
                                    <article key={it.id} className="market-item card">
                                        <div className="market-thumb" style={{ backgroundImage: `url(${it.image})` }} />
                                        <div className="market-body">
                                            <div className="market-meta">
                                                <span className="badge">{it.category.charAt(0).toUpperCase() + it.category.slice(1)}</span>
                                            </div>
                                            <h4 className="market-title">{it.title}</h4>
                                            <p className="market-desc">{it.desc}</p>
                                            <div className="market-contact">Contact: <span className="inline-link">{it.contact}</span></div>
                                        </div>
                                    </article>
                                ))}
                                {filtered.length === 0 && (
                                    <div className="empty" style={{ gridColumn: '1 / -1' }}>
                                        <div className="big">🛒</div>
                                        <p>No items match your filters. Try another category or clear search.</p>
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
                            <li>Use clear photos and concise titles.</li>
                            <li>Mention pickup location and timings.</li>
                            <li>Prefer campus meetups for safety.</li>
                        </ul>
                    </div>
                    <div className="card">
                        <div className="card-head"><h3>Browse quickly</h3></div>
                        <div className="filters">
                            {CATEGORIES.filter(c => c !== 'all').map((c) => (
                                <button key={c} className="pill" onClick={() => setFilter(c)}>
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
