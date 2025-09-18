import React from 'react';
import { NavLink } from 'react-router-dom';
import './dashbaord.css';

export default function Developer() {
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
                        <div className="card-head"><h3>Developer</h3></div>
                        <p className="muted">Built with React and a sprinkle of caffeine. Contributions and ideas are welcome.</p>
                        <ul className="mini-list" style={{ marginTop: 8 }}>
                            <li><span className="badge">Stack</span> React, react-router, CSS modules.</li>
                            <li><span className="badge">Backend</span> Planned: Laravel + MySQL.</li>
                            <li><span className="badge">Contact</span> Drop a line via the Marketplace or Carpool contact links.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );
}
