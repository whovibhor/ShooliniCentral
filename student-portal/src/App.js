import './App.css';
import { Link, Outlet } from 'react-router-dom';

function App() {
  return (
    <div className="App">
      <nav style={{ padding: '12px', borderBottom: '1px solid #eee', display: 'flex', gap: 16, alignItems: 'center' }}>
        <Link to="/home">Home</Link>
        <Link to="/marketplace">Marketplace</Link>
        <Link to="/carpool">Carpool</Link>
        <Link to="/events">Events</Link>
        <Link to="/lostfound">Lost & Found</Link>
        <Link to="/roommates">Roommates</Link>
        <Link to="/vacancies">Vacancies</Link>
        <div style={{ marginLeft: 'auto' }}>
          <Link to="/admin/login">Admin Login</Link>
        </div>
      </nav>
      <main style={{ padding: 16 }}>
        <Outlet />
      </main>
    </div>
  );
}

export default App;
