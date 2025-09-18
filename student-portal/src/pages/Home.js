import React, { useCallback, useEffect, useRef, useState } from 'react';
import { NavLink } from 'react-router-dom';
import { FiHome, FiShoppingCart, FiUsers, FiCalendar, FiSearch, FiUserCheck, FiPlus, FiLock } from 'react-icons/fi';
import './dashbaord.css';

export default function Home() {
    const editorRef = useRef(null);
    const [collapsed, setCollapsed] = useState(false);
    const [submittedMsg, setSubmittedMsg] = useState('');
    const [count, setCount] = useState(0);
    const LIMIT = 800;

    const [showChooser, setShowChooser] = useState(false);
    const [postingMode, setPostingMode] = useState(null); // null until user chooses Confessions
    // Right panel quick data and UI state
    const lostItems = React.useMemo(() => ([
        { title: 'Blue water bottle', status: 'Found', location: 'Library foyer', time: '2h ago', contact: '98765 43210' },
        { title: 'Black wallet', status: 'Lost', location: 'Cafeteria', time: 'Today 3:10 PM', contact: '—' },
        { title: 'USB drive', status: 'Found', location: 'Lab 3', time: 'Yesterday', contact: '—' },
        { title: 'Maths notebook', status: 'Found', location: 'Seminar Hall', time: '30m ago', contact: '—' },
    ]), []);
    const trips = React.useMemo(() => ([
        { start: 'Campus Gate', end: 'Solan', time: '6:00 PM' },
        { start: 'Admin Block', end: 'Shimla', time: '7:30 AM' },
        { start: 'Bus Stand', end: 'Dharampur', time: '5:15 PM' },
        { start: 'Library', end: 'Kandaghat', time: '8:00 PM' },
    ]), []);
    const [lfFlipped, setLfFlipped] = useState(false);
    const [lfIdx, setLfIdx] = useState(0);
    const [cpFlipped, setCpFlipped] = useState(false);
    const [cpIdx, setCpIdx] = useState(0);

    // Auto-fit heights for right-panel flip cards
    const lfInnerRef = useRef(null);
    const lfFrontRef = useRef(null);
    const lfBackRef = useRef(null);
    const cpInnerRef = useRef(null);
    const cpFrontRef = useRef(null);
    const cpBackRef = useRef(null);

    const updateLfHeight = useCallback(() => {
        const inner = lfInnerRef.current;
        if (!inner) return;
        const activeFace = (lfFlipped ? lfBackRef.current : lfFrontRef.current);
        if (activeFace) {
            const h = activeFace.scrollHeight;
            inner.style.height = h + 'px';
        }
    }, [lfFlipped]);
    const updateCpHeight = useCallback(() => {
        const inner = cpInnerRef.current;
        if (!inner) return;
        const activeFace = (cpFlipped ? cpBackRef.current : cpFrontRef.current);
        if (activeFace) {
            const h = activeFace.scrollHeight;
            inner.style.height = h + 'px';
        }
    }, [cpFlipped]);

    useEffect(() => {
        // initialize heights after first paint
        const id = requestAnimationFrame(() => {
            updateLfHeight();
            updateCpHeight();
        });
        const onResize = () => {
            updateLfHeight();
            updateCpHeight();
        };
        window.addEventListener('resize', onResize);
        return () => {
            cancelAnimationFrame(id);
            window.removeEventListener('resize', onResize);
        };
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    useEffect(() => { updateLfHeight(); }, [updateLfHeight, lfIdx, lostItems]);
    useEffect(() => { updateCpHeight(); }, [updateCpHeight, cpIdx, trips]);

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

    // Note: In future we can add feed loading here.

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
                                        <FiLock /> Find My Stay
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

                        {/* Confessions-only feed with empty placeholder for now */}
                        <div className="card">
                            <div className="card-head">
                                <h3>Confessions</h3>
                            </div>
                            <div className="empty">
                                <div className="big">🤫</div>
                                <p>No confessions yet. Your secret’s safe… for now.</p>
                                <p className="muted">Tap “Post” above to whisper to the campus.</p>
                            </div>
                        </div>
                    </div>
                </main>

                {/* Right Column */}
                <aside className="right">
                    <div className="card">
                        <div className="card-head">
                            <h3>Lost &amp; Found</h3>
                            <NavLink to="/lostfound" className="inline-link">View all</NavLink>
                        </div>
                        <div className={`lf-card ${lfFlipped ? 'is-flipped' : ''}`}>
                            <div className="lf-inner" ref={lfInnerRef}>
                                <div className="lf-front" ref={lfFrontRef}>
                                    <ul className="mini-list">
                                        {lostItems.map((it, i) => (
                                            <li key={i} className="clickable lf-item" onClick={() => { setLfIdx(i); setLfFlipped(true); }}>
                                                <span className={`badge ${it.status.toLowerCase()}`}>{it.status}</span>
                                                <div className="lf-text">
                                                    <div className="lf-title">{it.title}</div>
                                                    <div className="lf-meta">{it.location} · {it.time}</div>
                                                </div>
                                            </li>
                                        ))}
                                    </ul>
                                </div>
                                <div className="lf-back" ref={lfBackRef}>
                                    {(() => {
                                        const it = lostItems[lfIdx] || lostItems[0];
                                        return (
                                            <div className="detail-wrap">
                                                <h4 className="detail-title">{it.title}</h4>
                                                <div className="detail-grid">
                                                    <div><span className="dt">Status</span><span className="dd">{it.status}</span></div>
                                                    <div><span className="dt">Location</span><span className="dd">{it.location}</span></div>
                                                    <div><span className="dt">Contact</span><span className="dd">{it.contact}</span></div>
                                                </div>
                                                <div className="btn-row">
                                                    <button className="secondary">More</button>
                                                    <button className="primary" onClick={() => setLfFlipped(false)}>Back</button>
                                                </div>
                                            </div>
                                        );
                                    })()}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="card">
                        <div className="card-head">
                            <h3>Carpool</h3>
                            <NavLink to="/carpool" className="inline-link">View all</NavLink>
                        </div>
                        <div className={`cp-card ${cpFlipped ? 'is-flipped' : ''}`}>
                            <div className="cp-inner" ref={cpInnerRef}>
                                <div className="cp-front" ref={cpFrontRef}>
                                    <div className="trip-list">
                                        {trips.map((t, i) => (
                                            <div className="trip clickable" key={i} onClick={() => { setCpIdx(i); setCpFlipped(true); }}>
                                                <div className="line" />
                                                <div className="label start">{t.start}</div>
                                                <div className="time-dot">{t.time}</div>
                                                <div className="label end">{t.end}</div>
                                            </div>
                                        ))}
                                    </div>
                                </div>
                                <div className="cp-back" ref={cpBackRef}>
                                    {(() => {
                                        const t = trips[cpIdx] || trips[0];
                                        return (
                                            <div className="detail-wrap">
                                                <div className="muted" style={{ marginBottom: 8 }}>
                                                    <button className="inline-link" onClick={() => setCpFlipped(false)}>← Back</button>
                                                </div>
                                                <h4 className="detail-title">{t.start} → {t.end}</h4>
                                                <div className="detail-grid">
                                                    <div><span className="dt">From</span><span className="dd">{t.start}</span></div>
                                                    <div><span className="dt">To</span><span className="dd">{t.end}</span></div>
                                                    <div><span className="dt">Time</span><span className="dd">{t.time}</span></div>
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
                </aside>
            </div>
        </div>
    );
}
