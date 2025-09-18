# ShooliniCentral – Local Development

This repo contains:
- backend/ – Laravel API (Sanctum, API routing)
- student-portal/ – React SPA (CRA)

Local DB: Use WAMP MySQL. Create a database named `student_portal`. Update backend/.env with DB credentials.

Iteration 1 checklist
- [x] Scaffold Laravel + React
- [x] Sanctum installed and migrations published
- [x] API routes: /api/health, /api/admin/login, /api/admin/logout
- [x] CORS enabled for localhost:3000
- [ ] Migrate DB and seed Admin

Run locally
- Backend: set .env DB creds; then `php artisan migrate` and `php artisan serve`
- Frontend: set REACT_APP_API_BASE_URL in student-portal/.env (e.g. http://127.0.0.1:8000/api); then `npm start`
