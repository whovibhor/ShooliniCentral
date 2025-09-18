import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import App from './App';
import Login from './pages/Login';
import Home from './pages/Home';
import Dashboard from './pages/Dashboard';
import Marketplace from './pages/Marketplace';
import Carpool from './pages/Carpool';
import Events from './pages/Events';
import LostFound from './pages/LostFound';
import FindMyStay from './pages/FindMyStay';
import Admin from './pages/Admin';
import About from './pages/About';
import Developer from './pages/Developer';
import Plans from './pages/Plans';
import ProtectedRoute from './components/ProtectedRoute';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/home" replace />} />
        <Route path="/" element={<App />}>
          <Route path="/home" element={<Home />} />
          <Route path="/dashboard" element={<Dashboard />} />
          <Route path="/marketplace" element={<Marketplace />} />
          <Route path="/carpool" element={<Carpool />} />
          <Route path="/events" element={<Events />} />
          <Route path="/lostfound" element={<LostFound />} />
          <Route path="/findmystay" element={<FindMyStay />} />
          <Route path="/about" element={<About />} />
          <Route path="/developer" element={<Developer />} />
          <Route path="/plans" element={<Plans />} />
          <Route path="/roommates" element={<Navigate to="/findmystay" replace />} />
          <Route path="/vacancies" element={<Navigate to="/findmystay" replace />} />
          <Route path="/admin/login" element={<Login />} />
          <Route path="/admin" element={
            <ProtectedRoute>
              <Admin />
            </ProtectedRoute>
          } />
        </Route>
        <Route path="*" element={<Navigate to="/home" replace />} />
      </Routes>
    </BrowserRouter>
  </React.StrictMode>
);
