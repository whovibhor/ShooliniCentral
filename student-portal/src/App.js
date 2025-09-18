import './App.css';
import { Link, Outlet } from 'react-router-dom';

function App() {
  return (
    <div className="App">
      <nav style={{ padding: '12px', borderBottom: '1px solid #eee' }}>
        <Link to="/" style={{ marginRight: 16 }}>Confessions</Link>
        <Link to="/marketplace" style={{ marginRight: 16, pointerEvents: 'none', opacity: 0.4 }}>Marketplace (soon)</Link>
        <Link to="/rides" style={{ marginRight: 16, pointerEvents: 'none', opacity: 0.4 }}>Rides (soon)</Link>
        <Link to="/admin/login" style={{ float: 'right' }}>Admin Login</Link>
      </nav>
      <main style={{ padding: 16 }}>
        <Outlet />
      </main>
    </div>
  );
}

export default App;
