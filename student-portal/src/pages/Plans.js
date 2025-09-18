import React from 'react';
import { NavLink } from 'react-router-dom';
import './dashbaord.css';

export default function Plans() {
    return (
        <div className="home-dark">
            <header className="topbar">
                <div className="brand">Shoolini Central</div>
                <div className="topbar-spacer" />
                <div className="topbar-actions">
                    <NavLink to="/about" className="hbtn">About</NavLink>
                    <NavLink to="/developer" className="hbtn">Developer</NavLink>
                    <NavLink to="/plans" className="hbtn">Plans</NavLink>
                </div>
            </header>
            <div className="page-body">
                <div className="wide-inner">
                    <div className="card">
                        <div className="card-head"><h3>Plans</h3></div>
                        <ul className="mini-list">
                            <li><span className="badge">Short-term</span> Wire frontend to backend APIs for persistence.</li>
                            <li><span className="badge">Next</span> Authentication for posting and moderation tools.</li>
                            <li><span className="badge">Nice-to-have</span> Mobile PWA, notifications, and profile pages.</li>
                        </ul>
                        <div className="banner" style={{ marginTop: 10 }}>🗺️ Roadmaps are like hostel mess menus: plan ahead, improvise later.</div>
                    </div>
                </div>
            </div>
        </div>
    );
}
