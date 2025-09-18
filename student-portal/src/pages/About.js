import React from 'react';
import { NavLink } from 'react-router-dom';
import './dashbaord.css';

export default function About() {
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
                        <div className="card-head"><h3>About</h3></div>
                        <p className="muted">Shoolini Central is a student-run hub bringing Marketplace, Carpool, Events, Lost & Found, and Find My Stay into one clean, fast experience.</p>
                        <ul className="mini-list" style={{ marginTop: 8 }}>
                            <li><span className="badge">Focus</span> Simple, fast, campus-first utilities.</li>
                            <li><span className="badge">Vision</span> Reduce friction for day-to-day student life.</li>
                            <li><span className="badge">Status</span> MVP with sample data; backend wiring next.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
}
