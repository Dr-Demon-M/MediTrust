<p align="center">
  <img src="https://skillicons.dev/icons?i=php,laravel,mysql,vite,tailwind,alpinejs" alt="Tech stack" />
</p>

# 🏥 MediTrust — Clinic & Doctor Appointment Platform

<p>
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+" />
  <img src="https://img.shields.io/badge/MySQL-database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Pusher-real--time-300D4F?style=for-the-badge&logo=pusher&logoColor=white" alt="Pusher" />
  <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind" />
</p>

A medical appointment platform built with **Laravel 12** and **PHP 8.2+**. Patients browse specialties and doctors, book appointments, and chat with their doctor in real time; doctors and staff manage everything from a dashboard.

## ✨ Features

### 🧑‍🤝‍🧑 Patient side
- Browse departments / specialties, services, and doctor profiles
- Search doctors
- Book appointments from a doctor's availability schedule
- **Real-time chat** with the clinic about an appointment (Pusher / Laravel Echo)
- Patient profile with attachments, email verification, and two-factor columns
- Rate-limited contact form

### 🩺 Doctor / staff dashboard (`/admin`)
- Separate authentication guards for patients (`patient`) and staff (`web`)
- Doctor onboarding and profile completion
- Manage specialties, services, and per-specialty featured services
- **Availability schedules** per doctor with per-day exceptions
- Appointment workflow: pending → confirmed → completed, with appointment logs
- Notifications (mark read / read all) linked to appointments
- Todo / task lists

### 🔌 REST API
- Token-authenticated API with **Laravel Sanctum**
- Tasks with categories and favorites, and profile management endpoints

## 🧰 Tech Stack

| Layer | Tools |
| --- | --- |
| Backend | Laravel 12, PHP 8.2+, MySQL |
| Auth | Multi-guard (`web` for staff/doctors, `patient` for patients), Sanctum for API tokens |
| Real-time | Pusher, Laravel Echo |
| Frontend | Blade, Vite, Tailwind CSS, Alpine.js |

## 🚀 Installation

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

### 🔑 Optional services

| Feature | .env keys |
| --- | --- |
| Real-time chat & notifications | `PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET`, `PUSHER_APP_CLUSTER`, `BROADCAST_CONNECTION=pusher` |
| Mail (verification, notifications) | `MAIL_*` |

Staff/doctor dashboard lives at `/admin`; patient pages and booking are on the public routes.

## 🧪 Testing

```bash
php artisan test
```
