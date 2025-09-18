import React from 'react';
import { Link } from 'react-router-dom';
import './dashbaord.css';

export default function Home() {
    return (
        <div className="page">
            <h2>This is the dashbaord page</h2>
            <div className="links">
                <Link to="/home">Home (dashbaord)</Link>
                <Link to="/marketplace">Marketplace</Link>
                <Link to="/carpool">Carpool</Link>
                <Link to="/events">Events & Notices</Link>
                <Link to="/lostfound">Lost & Found</Link>
                <Link to="/roommates">Roommate Finder</Link>
                <Link to="/vacancies">Vacant Rooms</Link>
                <Link to="/admin/login">Admin Login</Link>
            </div>
        </div>
    );
}
