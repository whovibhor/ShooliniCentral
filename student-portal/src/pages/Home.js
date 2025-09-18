import React, { useEffect, useRef, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus, FiLock, FiClock } from 'react-icons/fi';
import { FaCarSide } from 'react-icons/fa';
import './dashbaord.css';

export default function Home() {
    const editorRef = useRef(null);
    const [collapsed, setCollapsed] = useState(false);
    const [submittedMsg, setSubmittedMsg] = useState('');
    const [count, setCount] = useState(0);
    const LIMIT = 800;
    const [filter, setFilter] = useState('all');
    const [loadingFeed, setLoadingFeed] = useState(true);
    const [showChooser, setShowChooser] = useState(false);
    const [postingMode, setPostingMode] = useState(null); // null until user chooses Confessions

    const exec = (cmd, value = null) => {
        // text-only: allow formatting but no images
        if (cmd === 'createLink') {
            const url = window.prompt('Enter URL');
            if (!url) return;
            document.execCommand(cmd, false, url);
            return;
        }
        if (cmd === 'removeFormat') {
            document.execCommand('removeFormat', false, null);
            document.execCommand('unlink', false, null);
            return;
        }
        document.execCommand(cmd, false, value);
    };

    const getPlainText = () => {
        const html = editorRef.current?.innerHTML || '';
        const tmp = document.createElement('div');
        tmp.innerHTML = html;
        return tmp.textContent?.trim() || '';
    };

    // count update
    const updateCount = () => {
        const text = getPlainText();
        setCount(text.length);
    };

    useEffect(() => {
        // mock feed loading
        const t = setTimeout(() => setLoadingFeed(false), 900);
        return () => clearTimeout(t);
    }, []);

    const handleSubmit = () => {
        const text = getPlainText();
        if (!text) {
            setSubmittedMsg('Please write something before submitting.');
            setTimeout(() => setSubmittedMsg(''), 2500);
            return;
        }
        if (text.length > LIMIT) {
            setSubmittedMsg(`Please reduce your post. Max ${LIMIT} characters.`);
            setTimeout(() => setSubmittedMsg(''), 2500);
            return;
        }
        // TODO: Wire to backend API in a later iteration.
        setSubmittedMsg('Submitted for verification. May take up to 24 hours.');
        // clear editor
        if (editorRef.current) editorRef.current.innerHTML = '';
        setCount(0);
        setTimeout(() => setSubmittedMsg(''), 4000);
    };

    return (
        <div className="home-dark">
            {/* Top header (brand only) */}
            <header className="topbar">
                <div className="brand" title="Home">Shoolini Central</div>
                <div className="topbar-spacer" />
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
                        <li><NavLink to="/roommates" className={({ isActive }) => isActive ? 'active' : ''} title="Roommate Finder"><span className="icon"><FiUserCheck /></span><span className="hide-when-collapsed">Roommate Finder</span></NavLink></li>
                        <li><NavLink to="/vacancies" className={({ isActive }) => isActive ? 'active' : ''} title="Vacant Rooms"><span className="icon"><FiHome /></span><span className="hide-when-collapsed">Vacant Rooms</span></NavLink></li>
                    </ul>
                </aside>

                {/* Middle Column */}
                <main className="main">
                    <div className="main-inner">
                        <div className="card">
                            <div className="card-head">
                                <h3>Create a Post</h3>
                                <button
                                    className="post-btn"
                                    onClick={() => {
                                        setShowChooser((v) => !v);
                                        // hide editor when reopening the chooser
                                        if (!showChooser) setPostingMode(null);
                                    }}
                                    title="New post"
                                    aria-haspopup="true"
                                    aria-expanded={showChooser}
                                >
                                    <FiPlus />
                                    <span>Post</span>
                                </button>
                            </div>
                            {showChooser && (
                                <div className="post-chooser" role="dialog" aria-label="Choose what to post">
                                    <button
                                        className="chooser-item active"
                                        onClick={() => {
                                            setPostingMode('confession');
                                            setShowChooser(false);
                                        }}
                                    >
                                        Confessions
                                    </button>
                                    <button className="chooser-item" disabled title="Coming soon">
                                        <FiLock /> Lost & Found
                                    </button>
                                    <button className="chooser-item" disabled title="Coming soon">
                                        <FiLock /> Carpool
                                    </button>
                                    <button className="chooser-item" disabled title="Coming soon">
                                        <FiLock /> Room Vacancy
                                    </button>
                                    <button className="chooser-item" disabled title="Coming soon">
                                        <FiLock /> Roommate Finder
                                    </button>
                                </div>
                            )}
                            {postingMode === 'confession' && !showChooser && (
                                <div className="toolbar">
                                    <button className="toolbtn" title="Bold" onClick={() => exec('bold')}><b>B</b></button>
                                    <button className="toolbtn" title="Italic" onClick={() => exec('italic')}><i>I</i></button>
                                    <button className="toolbtn" title="Underline" onClick={() => exec('underline')}><u>U</u></button>
                                    <button className="toolbtn" title="Bulleted list" onClick={() => exec('insertUnorderedList')}>• List</button>
                                    <button className="toolbtn" title="Numbered list" onClick={() => exec('insertOrderedList')}>1. List</button>
                                    <button className="toolbtn" title="Add link" onClick={() => exec('createLink')}>Link</button>
                                    <button className="toolbtn" title="Clear formatting" onClick={() => exec('removeFormat')}>Clear</button>
                                </div>
                            )}
                            {postingMode === 'confession' && !showChooser && (
                                <div
                                    ref={editorRef}
                                    className="editor"
                                    contentEditable
                                    role="textbox"
                                    aria-multiline="true"
                                    data-placeholder="Share something with your campus (no images)."
                                    onPaste={(e) => {
                                        // sanitize paste to plain text
                                        e.preventDefault();
                                        const text = e.clipboardData.getData('text/plain');
                                        document.execCommand('insertText', false, text);
                                    }}
                                    onInput={updateCount}
                                    style={{ outline: 'none' }}
                                />)}
                            {postingMode === 'confession' && !showChooser && (
                                <div className="actions">
                                    <button className="primary" onClick={handleSubmit} disabled={count > LIMIT}>Submit</button>
                                    <span className="muted">Text only. Links allowed. Images disabled.</span>
                                    <span className={`counter ${count > LIMIT ? 'over' : ''}`}>{count}/{LIMIT}</span>
                                </div>
                            )}
                            {submittedMsg && (
                                <div className="banner" style={{ marginTop: 10 }}>{submittedMsg}</div>
                            )}
                        </div>

                        {/* Placeholder feed card */}
                        <div className="card">
                            <div className="filters">
                                {['all', 'marketplace', 'events', 'lostfound'].map(f => (
                                    <button key={f} className={`pill ${filter === f ? 'active' : ''}`} onClick={() => setFilter(f)}>
                                        {f === 'all' && 'All'}
                                        {f === 'marketplace' && 'Marketplace'}
                                        {f === 'events' && 'Events'}
                                        {f === 'lostfound' && 'Lost & Found'}
                                    </button>
                                ))}
                            </div>
                            <h3 style={{ margin: '4px 6px 10px' }}>Recent Posts</h3>
                            {loadingFeed ? (
                                <div>
                                    <div className="skeleton-card" style={{ marginTop: 8 }}>
                                        <div className="sk-line sk-title"></div>
                                        <div className="sk-line sk-wide"></div>
                                        <div className="sk-line sk-mid"></div>
                                        <div className="sk-line sk-narrow"></div>
                                    </div>
                                    <div className="skeleton-card" style={{ marginTop: 12 }}>
                                        <div className="sk-line sk-title"></div>
                                        <div className="sk-line sk-wide"></div>
                                        <div className="sk-line sk-mid"></div>
                                    </div>
                                </div>
                            ) : (
                                <p className="muted">Coming soon: a feed of verified posts.</p>
                            )}
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <h3 style={{ margin: '4px 6px 10px' }}>Lost &amp; Found</h3>
                        <ul className="mini-list">
                            <li>
                                <span className="badge found">Found</span>
                                Blue water bottle near library
                            </li>
                            <li>
                                <span className="badge lost">Lost</span>
                                Black wallet in cafeteria
                            </li>
                            <li>
                                <span className="badge found">Found</span>
                                USB drive at lab 3
                            </li>
                        </ul>
                        <div className="mini-actions">
                            <NavLink to="/lostfound" className="muted">View all →</NavLink>
                        </div>
                    </div>

                    <div className="card">
                        <h3 style={{ margin: '4px 6px 10px' }}>Carpool</h3>
                        <ul className="carpool-list">
                            <li className="carpool-item">
                                <span className="place start">Campus Gate</span>
                                <span className="trip-meta"><FaCarSide className="car-ic" /><FiClock /> <span className="time">6:00 PM</span></span>
                                <span className="place end">Solan</span>
                            </li>
                            <li className="carpool-item">
                                <span className="place start">Admin Block</span>
                                <span className="trip-meta"><FaCarSide className="car-ic" /><FiClock /> <span className="time">7:30 AM</span></span>
                                <span className="place end">Shimla</span>
                            </li>
                            <li className="carpool-item">
                                <span className="place start">Bus Stand</span>
                                <span className="trip-meta"><FaCarSide className="car-ic" /><FiClock /> <span className="time">5:15 PM</span></span>
                                <span className="place end">Dharampur</span>
                            </li>
                        </ul>
                        <div className="mini-actions">
                            <NavLink to="/carpool" className="muted">Explore carpool →</NavLink>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    );
}
