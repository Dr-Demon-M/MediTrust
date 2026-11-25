# MediTrust — Clinic & Doctor Appointment Platform

A medical appointment platform built with **Laravel 12** and **PHP 8.2+**. Patients browse specialties and doctors, book appointments, and chat with their doctor in real time; doctors and staff manage everything from a dashboard.

## Features

### Patient side
- Browse departments / specialties, services, and doctor profiles
- Search doctors
- Book appointments from a doctor's availability schedule
- **Real-time chat** with the clinic about an appointment (Pusher / Laravel Echo)
- Patient profile with attachments, email verification, and two-factor columns
- Rate-limited contact form

### Doctor / staff dashboard (`/admin`)
- Separate authentication guards for patients (`patient`) and staff (`web`)
- Doctor onboarding and profile completion
- Manage specialties, services, and per-specialty featured services
- **Availability schedules** per doctor with per-day exceptions
- Appointment workflow: pending → confirmed → completed, with appointment logs
- Notifications (mark read / read all) linked to appointments
- Todo / task lists

### REST API
- Token-authenticated API with **Laravel Sanctum**
- Tasks with categories and favorites, and profile management endpoints

## Tech Stack

| Layer | Tools |
| --- | --- |
| Backend | Laravel 12, PHP 8.2+, MySQL |
| Auth | Multi-guard (`web` for staff/doctors, `patient` for patients), Sanctum for API tokens |
| Real-time | Pusher, Laravel Echo |
| Frontend | Blade, Vite, Tailwind CSS, Alpine.js |

## Installation

**Requirements:** PHP 8.2+, Composer, Node.js 18+, MySQL

```bash
# 1. Clone the repository
git clone https://github.com/Dr-Demon-M/MediTrust.git
cd MediTrust

# 2. Install PHP dependencies
composer install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Create a MySQL database (default name: example)
#    then set DB_DATABASE / DB_USERNAME / DB_PASSWORD in .env

# 5. Run migrations and seeders (specialties, doctors, services, availability, demo tasks)
php artisan migrate --seed

# 6. Install and build frontend assets
npm install
npm run build        # or: npm run dev

# 7. Serve the app
php artisan serve
```

> Steps 2–6 can also run in one shot with `composer run setup` (uses `migrate --force` without seeding).

### Optional services

| Feature | .env keys |
| --- | --- |
| Real-time chat & notifications | `PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET`, `PUSHER_APP_CLUSTER`, `BROADCAST_CONNECTION=pusher` |
| Mail (verification, notifications) | `MAIL_*` |

Staff/doctor dashboard lives at `/admin`; patient pages and booking are on the public routes.

## Testing

```bash
php artisan test
```
