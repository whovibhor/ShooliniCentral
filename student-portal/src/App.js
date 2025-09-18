import './App.css';
import { Outlet } from 'react-router-dom';

function App() {
  return (
    <div className="App" style={{ minHeight: '100vh' }}>
      <Outlet />
    </div>
  );
}

export default App;
