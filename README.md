# Task Management App

A modern, user-friendly task management application built with Laravel. Each user can create, manage, and track their own tasks with the ability to mark tasks as completed. The application features authentication, authorization, and a clean, responsive interface.

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## Features

- **User Authentication**: Secure login and registration using Laravel Fortify
- **Task Management**: Create, read, update, and delete personal tasks
- **Status Tracking**: Mark tasks as pending, in progress, or completed
- **User Isolation**: Each user can only access their own tasks
- **Modern UI/UX**: Clean, responsive design built with Tailwind CSS
- **Authorization**: Robust access control to prevent unauthorized access
- **Comprehensive Testing**: Full test coverage for task management features

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Authentication**: Laravel Fortify
- **Database**: MySQL/PostgreSQL
- **Testing**: PHPUnit

## Installation

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js & NPM (for asset compilation)
- MySQL or PostgreSQL

### Setup Instructions

1. **Clone the repository**

    ```bash
    git clone https://github.com/abdullahdheir/task-management-app.git
    cd task-management-app
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment configuration**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure database**
   Edit your `.env` file and set your database credentials:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_management
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Run migrations**

    ```bash
    php artisan migrate
    ```

6. **Build assets**

    ```bash
    npm run build
    ```

7. **Start the development server**

    ```bash
    php artisan serve
    ```

    Visit `http://localhost:8000` in your browser.

## Project Structure

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── TaskController.php
│   └── Models/
│       ├── Task.php
│       └── User.php
├── database/
│   ├── factories/
│   │   ├── TaskFactory.php
│   │   └── UserFactory.php
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       └── 2026_05_25_114206_create_tasks_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── master.blade.php
│       └── tasks/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
├── routes/
│   └── web.php
└── tests/
    └── Feature/
        └── TaskControllerTest.php
```

## Database Schema

### Users Table

- `id` (Primary Key)
- `name` (String, Required)
- `email` (String, Unique, Required)
- `password` (String, Required)
- `email_verified_at` (Timestamp, Nullable)
- `remember_token` (String, Nullable)
- `created_at`, `updated_at` (Timestamps)

### Tasks Table

- `id` (Primary Key)
- `title` (String, Required)
- `owner_id` (Foreign Key to users, Required)
- `status` (Enum: pending, doing, completed, Default: pending)
- `started_at` (Timestamp, Nullable)
- `completed_at` (Timestamp, Nullable)
- `created_at`, `updated_at` (Timestamps)

## Usage

### Authentication

1. Navigate to `/login` to sign in
2. Navigate to `/register` to create a new account
3. After registration, you'll be redirected to the login page

### Managing Tasks

1. Navigate to `/tasks` to view all your tasks
2. Click "Add New Task" to create a new task
3. Enter the task title and submit
4. Use the "Mark Complete/Pending" button to toggle task status
5. Edit or delete tasks from the task list

## Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style

- Follow PSR-12 coding standards
- Use Laravel conventions for code organization
- Write clear, descriptive commit messages
- Add comments for complex logic

## Running Tests

Run the test suite with:

```bash
php artisan test
```

## Security

If you discover any security related issues, please email the maintainers instead of using the issue tracker.

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support, please open an issue on GitHub or contact the maintainers.

## Acknowledgments

- Built with [Laravel](https://laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Authentication by [Laravel Fortify](https://laravel.com/docs/fortify)
