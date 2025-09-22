# ShooliniCentral – Local Development

This repo now contains only:
- backend/ – Laravel API (Sanctum, API routing)

Note: The React app (`student-portal/`) and its dependencies were removed on 2025-09-22 to proceed with a Laravel + SQL only stack.

Local DB: Use WAMP MySQL. Create a database named `student_portal`. Update `backend/.env` with DB credentials.

Iteration 1 checklist
- [x] Scaffold Laravel
- [x] Sanctum installed and migrations published
- [x] API routes: /api/health, /api/admin/login, /api/admin/logout
- [ ] Migrate DB and seed Admin

Run locally
- Backend: set .env DB creds; then `php artisan migrate` and `php artisan serve`
