# 💪 HealthTrack — Laravel Health & Fitness Task Management System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)

**A structured digital solution for planning, organizing, and monitoring daily health and wellness activities.**

</div>

---

## 👨‍💻 Developer

| Field        | Details                          |
|--------------|----------------------------------|
| **Name**     | Muhammad Moeed Sajid             |
| **University**| National University of Modern Languages (NUML) |
| **Project**  | Laravel Health & Fitness Task Management System |
| **Framework**| Laravel 13 with Bootstrap 5      |

---

## 📋 Project Overview

HealthTrack is a web-based Health & Fitness Task Management System built using the **MVC architecture of Laravel**. It allows users to register, log in, and manage personalized health-related tasks including workout schedules, diet plans, medical appointments, hydration tracking, and daily exercise routines.

---

## ✨ Features

- 🔐 **User Authentication** — Register, Login, Logout with Laravel Breeze
- 📋 **Task Management** — Full CRUD (Create, Read, Update, Delete)
- 🏷️ **Task Categories** — Workout, Diet Plan, Medical, Hydration, Exercise
- 🎯 **Priority Levels** — Low, Medium, High
- 📊 **Task Status** — Pending, In-Progress, Completed
- 🔍 **Filter & Search** — Filter tasks by category, status, and priority
- 📈 **Dashboard** — Summary stats with animated progress bar
- ⚠️ **Overdue Detection** — Highlights tasks past their due date
- 👤 **User Profile** — Update name, email, and password
- 📱 **Responsive Design** — Mobile-friendly Bootstrap 5 layout

---

## 🛠️ Tech Stack

| Technology       | Version  | Purpose                        |
|------------------|----------|--------------------------------|
| Laravel          | 13.x     | PHP Web Framework (MVC)        |
| PHP              | 8.4      | Server-side Language           |
| Bootstrap        | 5.3      | Frontend UI Framework          |
| Font Awesome     | 7.0      | Icons                          |
| SQLite           | —        | Database                       |
| Vite             | —        | Asset Bundler                  |
| Laravel Breeze   | —        | Authentication Scaffolding     |

---

## 📁 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php
│       ├── TaskController.php
│       └── ProfileController.php
├── Models/
│   ├── User.php
│   ├── Task.php
│   └── Category.php
database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_categories_table.php
│   └── create_tasks_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── CategorySeeder.php
resources/
└── views/
    ├── layouts/
    │   ├── app.blade.php
    │   └── guest.blade.php
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── dashboard.blade.php
    └── tasks/
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── show.blade.php
routes/
├── web.php
└── auth.php
```

---

## 🗄️ Database Schema

### `users` table
| Column       | Type      |
|--------------|-----------|
| id           | bigint PK |
| name         | string    |
| email        | string    |
| password     | string    |
| created_at   | timestamp |
| updated_at   | timestamp |

### `categories` table
| Column     | Type      |
|------------|-----------|
| id         | bigint PK |
| name       | string    |
| color      | string    |
| icon       | string    |
| created_at | timestamp |
| updated_at | timestamp |

### `tasks` table
| Column       | Type      |
|--------------|-----------|
| id           | bigint PK |
| user_id      | FK → users|
| category_id  | FK → categories |
| title        | string    |
| description  | text      |
| priority     | enum (low, medium, high) |
| status       | enum (pending, in-progress, completed) |
| start_date   | date      |
| due_date     | date      |
| completed_at | timestamp |
| created_at   | timestamp |
| updated_at   | timestamp |

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.4+
- Composer
- Node.js & npm

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/your-username/hftms.git
cd hftms
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install Node dependencies**
```bash
npm install
```

**4. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

**5. Set up the database** — edit `.env`:
```env
DB_CONNECTION=sqlite
```

Create the SQLite file:
```bash
touch database/database.sqlite
```

**6. Run migrations and seeders**
```bash
php artisan migrate --seed
```

**7. Build frontend assets**
```bash
npm run build
```

**8. Start the development server**
```bash
php artisan serve
```

**9. Visit the app**
```
http://127.0.0.1:8000
```

---

## 🔑 Default Task Categories (Seeded)

| Icon | Category  | Color   |
|------|-----------|---------|
| 💪   | Workout   | Blue    |
| 🥗   | Diet Plan | Green   |
| 🏥   | Medical   | Red     |
| 💧   | Hydration | Cyan    |
| 🏃   | Exercise  | Orange  |

---

## 📸 Application Pages

| Route            | Page                  |
|------------------|-----------------------|
| `/register`      | User Registration     |
| `/login`         | User Login            |
| `/dashboard`     | Dashboard & Stats     |
| `/tasks`         | Task List with Filters|
| `/tasks/create`  | Create New Task       |
| `/tasks/{id}`    | Task Detail View      |
| `/tasks/{id}/edit` | Edit Task           |
| `/profile`       | User Profile Settings |

---

## 📄 License

This project is developed for **academic purposes** at NUML as part of a web development course assignment.

---

<div align="center">
  Made with ❤️ by <strong>Muhammad Moeed Sajid</strong> — NUML
</div>