# Laravel Gym Management System

A complete gym management system built with Laravel, featuring role-based access control for administrators, trainers, and members.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)

## 🚀 Features

### 👨‍💼 Admin Panel
- **Dashboard** with overview statistics
- **Member Management** - Add, edit, view, and delete members
- **Trainer Management** - Manage trainer profiles and availability
- **Payment Tracking** - Monitor membership payments and revenue
- **System Analytics** - View gym performance metrics

### 🏋️ Trainer Panel
- **Workout Plans** - Create and manage customized workout plans for members
- **Attendance Tracking** - Record member gym visits and sessions
- **Progress Monitoring** - Track member fitness progress
- **Client Management** - View assigned members and their details

### 👤 Member Panel
- **Booking System** - Schedule sessions with trainers
- **Progress Tracking** - View personal fitness progress and metrics
- **Payment History** - Check membership payment records
- **Profile Management** - Update personal information and preferences

## 📦 Download & Installation

### Option 1: Download ZIP (Easiest)
1. Go to [GitHub Repository](https://github.com/Aikun100/laravel-gym-system)
2. Click the green "Code" button
3. Select "Download ZIP"
4. Extract the ZIP file to your desired location

### Option 2: Clone with Git
```bash
git clone https://github.com/Aikun100/laravel-gym-system.git
cd laravel-gym-system

# 🛠️ Laravel Gym Management System Setup

# ============================================
# 🔧 Prerequisites
# ============================================
# Make sure the following are installed:
# - PHP 8.2 or higher
# - Composer
# - Node.js & NPM
# - MySQL 5.7+ or MariaDB
# - Apache/Nginx or PHP built-in server

# ============================================
# 🪜 Step-by-Step Setup
# ============================================

# 1️⃣ Install PHP Dependencies
composer install

# 2️⃣ Install Node.js Dependencies
npm install

# 3️⃣ Environment Configuration
cp .env.example .env
php artisan key:generate

# 4️⃣ Database Setup
# Create a MySQL database named 'laravel_gym'
# Then update the .env file with your database credentials:
# --------------------------------------------
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel_gym
# DB_USERNAME=root
# DB_PASSWORD=
# --------------------------------------------

# 5️⃣ Run Migrations & Seeders
php artisan migrate
php artisan db:seed

# 6️⃣ Build Frontend Assets
npm run build

# 7️⃣ Start Development Server
php artisan serve

# Once running, open your browser and navigate to:
# 👉 http://localhost:8000

# ============================================
# 🔐 Default Login Accounts
# ============================================
# Administrator:
#   Email: admin@example.com
#   Password: password
#   Access: Full system access
#
# Trainer:
#   Email: trainer@example.com
#   Password: password
#   Access: Manage workout plans, track attendance, view assigned members
#
# Member:
#   Email: member@example.com
#   Password: password
#   Access: Book sessions, view progress, make payments

# ============================================
# 🐛 Troubleshooting
# ============================================

# "Class not found" errors
composer dump-autoload

# Permission denied errors
chmod -R 755 storage bootstrap/cache

# Database connection issues
# - Verify database credentials in .env
# - Ensure MySQL/MariaDB server is running
# - Confirm the database exists

# Asset loading problems
php artisan config:clear
php artisan cache:clear
npm run build

# View logs for detailed errors
cat storage/logs/laravel.log

# ============================================
# 📞 Support
# ============================================
# - Check the Issues page on GitHub
# - Create a new issue with detailed description

# ============================================
# ✅ Done!
# Your Laravel Gym Management System is now ready.
# ============================================
