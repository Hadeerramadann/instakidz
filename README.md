<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Attendance Management System

## Introduction
attendance management system for a nursery, focusing on
performance, scalability, and advanced reporting. The system must allow teachers to mark
attendance, and provide insights into class attendance trends.

## Installation
Follow these steps to install the project:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Hadeerramadann/instakidz.git
   cd attendance-system
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Set up environment variables:**
   Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```
   Then update database and other configurations inside `.env`.
    ```bash
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=instakidz
        DB_USERNAME=root
        DB_PASSWORD=
    ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

## API Endpoints
   you can get the postman collection and environment inside the project 
   
   instakidz.postman_collection.json
   instakidz.postman_environment.json
   

### Authentication
- `POST /api/login` - Authenticate user and receive a JWT token.


### Attendance
- `POST /api/teacher/attendance/mark` - Mark attendance for students.
- `GET /api/general/attendance/class/{class_id}` - Get attendance statistics for a class.
- `GET /api/general/attendance/report?class_id={class_id}&start_date=yyyy-mm-dd&end_date=yyyy-mm-dd` - Generate attendance report.

## Features
- Secure authentication using JWT.
- Teachers can only manage attendance for their assigned classes.
- Real-time attendance statistics.
- Prevents duplicate attendance entries for the same student on the same day.
- Optimized queries for handling large datasets efficiently.

## Database Indexing
To improve performance, indexing has been added to the `attendances` table:
```php
Schema::table('attendance', function (Blueprint $table) {
    $table->index(['class_id', 'status'], 'attendance_class_status_index');
});
```



## Contact
For any inquiries, reach out to `hadeer2271996@gmail.com`.

