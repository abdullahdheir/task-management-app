# Focus - Task Management Application

A modern, collaborative task management application built with Laravel 13.x. Focus enables users and teams to organize work through projects, track tasks with deadlines, and collaborate seamlessly with team members.

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.0-38BDF8?style=flat-square&logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## Table of Contents

- [Project Goal](#project-goal)
- [Business Logic](#business-logic)
- [Project Structure](#project-structure)
- [Technology Stack](#technology-stack)
- [Database Schema](#database-schema)
- [Installation](#installation)
- [Deployment](#deployment)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Project Goal

Focus is designed to streamline task and project management for individuals and teams. The application aims to:

- **Enhance Productivity**: Provide intuitive tools for task organization and tracking
- **Facilitate Collaboration**: Enable teams to work together on projects with role-based access
- **Improve Visibility**: Offer dashboards and statistics for progress monitoring
- **Ensure Security**: Implement robust authentication and authorization mechanisms
- **Modern UX**: Deliver a responsive, accessible interface with dark mode support

## Business Logic

### Core Entities

**Users**

- Authentication via Laravel Fortify with two-factor authentication support
- Profile management with customizable settings
- Dark mode preference persistence
- Role-based access control within teams

**Teams**

- Team creation and management with privacy settings (public/private)
- Member invitation system with role assignments (owner, admin, member, guest)
- Team activity tracking and audit logs
- Workspace-level settings and permissions

**Projects**

- Project organization within teams or as personal projects
- Progress tracking based on task completion
- Timeline management with start and due dates
- Budget tracking and resource allocation
- Color coding and custom icons for visual organization

**Tasks**

- Hierarchical task structure with subtasks support
- Priority levels (low, medium, high) and categories (work, personal, health, finance, other)
- Due date and time tracking with overdue detection
- Task assignment to team members
- Comments and file attachments
- Status tracking (todo, in-progress, done)

**Activities**

- Automatic activity logging for all entity changes
- Polymorphic activity tracking for tasks, projects, and teams
- Recent activity feeds for team visibility

### Key Business Rules

1. **User Isolation**: Users can only access their own tasks unless explicitly granted access through team membership
2. **Team Ownership**: Team owners have full control over team settings and member management
3. **Project Access**: Project members can view and contribute to tasks based on their role
4. **Task Assignment**: Tasks can be assigned to any team member, with the creator retaining ownership
5. **Progress Calculation**: Project progress is automatically recalculated when task statuses change
6. **Soft Deletion**: Tasks, projects, and teams use soft deletion for data recovery
7. **Privacy Controls**: Private teams are only accessible to invited members

## Project Structure

```
├── app/
│   ├── Actions/              # Single-action classes for business logic
│   │   └── Tasks/
│   ├── Console/              # Artisan commands
│   │   └── Commands/
│   │       └── DarkModeClasses.php
│   ├── Enums/                # PHP enums for type safety
│   ├── Events/               # Event definitions
│   ├── Http/
│   │   ├── Controllers/      # Request handlers
│   │   │   ├── AttachmentController.php
│   │   │   ├── CalendarController.php
│   │   │   ├── CommentController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── SearchController.php
│   │   │   ├── SettingsController.php
│   │   │   ├── TaskController.php
│   │   │   └── TeamController.php
│   │   └── Middleware/       # HTTP middleware
│   ├── Listeners/            # Event listeners
│   ├── Models/               # Eloquent models
│   │   ├── Activity.php
│   │   ├── Comment.php
│   │   ├── Project.php
│   │   ├── Task.php
│   │   ├── TaskAttachment.php
│   │   ├── Team.php
│   │   └── User.php
│   ├── Policies/             # Authorization policies
│   │   ├── AttachmentPolicy.php
│   │   ├── ProjectPolicy.php
│   │   ├── TaskPolicy.php
│   │   └── TeamPolicy.php
│   ├── Providers/            # Service providers
│   └── Services/             # Business logic services
│       ├── ActivityService.php
│       ├── AttachmentService.php
│       ├── CalendarService.php
│       ├── DashboardService.php
│       ├── ProfileService.php
│       ├── ProjectService.php
│       ├── SettingsService.php
│       ├── TaskService.php
│       └── TeamService.php
├── bootstrap/                # Application bootstrap
├── config/                   # Configuration files
├── database/
│   ├── factories/            # Model factories for testing
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── public/                   # Public assets
├── resources/
│   ├── css/                  # Tailwind CSS configuration
│   │   └── colors.css
│   ├── js/                   # JavaScript assets
│   │   └── app.js
│   └── views/                # Blade templates
│       ├── layouts/          # Layout templates
│       │   └── app.blade.php
│       ├── partials/         # Reusable components
│       ├── projects/         # Project views
│       ├── settings/         # Settings views
│       ├── tasks/            # Task views
│       ├── teams/            # Team views
│       └── profile/          # Profile views
├── routes/
│   ├── console.php           # Console routes
│   └── web.php               # Web routes
├── storage/                  # Storage framework
├── tests/                    # Test suite
│   ├── Feature/              # Feature tests
│   └── Unit/                 # Unit tests
├── .env.example              # Environment template
├── artisan                   # Artisan CLI
├── composer.json             # PHP dependencies
├── package.json              # Node dependencies
├── tailwind.config.js        # Tailwind configuration
└── vite.config.js            # Vite configuration
```

## Technology Stack

### Backend

- **Framework**: Laravel 13.x
- **PHP Version**: 8.3+
- **Authentication**: Laravel Fortify (Two-Factor Authentication, Passkeys)
- **Database**: MySQL/PostgreSQL/SQLite
- **Queue**: Laravel Queue System
- **Logging**: Laravel Pail

### Frontend

- **Templating**: Blade
- **CSS Framework**: Tailwind CSS 4.0
- **JavaScript**: Alpine.js 3.15
- **Build Tool**: Vite 8.0
- **Dark Mode**: CSS variables with class-based strategy

### Development Tools

- **Testing**: PHPUnit 12.x
- **Code Style**: Laravel Pint
- **Package Manager**: Composer, NPM

## Database Schema

### Users Table

- `id` (Primary Key, UUID)
- `name` (String, Required)
- `email` (String, Unique, Required)
- `password` (String, Required)
- `avatar_url` (String, Nullable)
- `dark_mode` (Boolean, Default: false)
- `two_factor_secret` (String, Nullable)
- `two_factor_confirmed_at` (Timestamp, Nullable)
- `email_verified_at` (Timestamp, Nullable)
- `remember_token` (String, Nullable)
- `created_at`, `updated_at` (Timestamps)

### Teams Table

- `id` (Primary Key, UUID)
- `owner_id` (Foreign Key to users, Required)
- `name` (String, Required)
- `slug` (String, Unique, Required)
- `description` (Text, Nullable)
- `avatar` (String, Nullable)
- `privacy` (Enum: private, public, Default: private)
- `workspace_name` (String, Nullable)
- `created_at`, `updated_at`, `deleted_at` (Timestamps)

### Projects Table

- `id` (Primary Key, UUID)
- `owner_id` (Foreign Key to users, Required)
- `team_id` (Foreign Key to teams, Nullable)
- `name` (String, Required)
- `slug` (String, Unique, Required)
- `description` (Text, Nullable)
- `color` (String, Nullable)
- `icon` (String, Nullable)
- `status` (Enum: active, completed, archived, Default: active)
- `progress` (Integer, Default: 0)
- `budget` (Decimal, Nullable)
- `start_date` (Date, Nullable)
- `due_date` (Date, Nullable)
- `created_at`, `updated_at`, `deleted_at` (Timestamps)

### Tasks Table

- `id` (Primary Key, UUID)
- `user_id` (Foreign Key to users, Required - Creator)
- `assignee_id` (Foreign Key to users, Nullable - Assigned to)
- `project_id` (Foreign Key to projects, Nullable)
- `parent_id` (Foreign Key to tasks, Nullable - For subtasks)
- `title` (String, Required)
- `description` (Text, Nullable)
- `status` (Enum: todo, in-progress, done, Default: todo)
- `priority` (Enum: low, medium, high, Default: low)
- `category` (Enum: work, personal, health, finance, other, Nullable)
- `is_completed` (Boolean, Default: false)
- `completed_at` (Timestamp, Nullable)
- `due_date` (Date, Nullable)
- `due_time` (Time, Nullable)
- `sort_order` (Integer, Default: 0)
- `created_at`, `updated_at`, `deleted_at` (Timestamps)

### Comments Table

- `id` (Primary Key, UUID)
- `user_id` (Foreign Key to users, Required)
- `commentable_id` (Integer, Required - Polymorphic)
- `commentable_type` (String, Required - Polymorphic)
- `content` (Text, Required)
- `created_at`, `updated_at` (Timestamps)

### Activities Table

- `id` (Primary Key, UUID)
- `user_id` (Foreign Key to users, Required)
- `subject_id` (Integer, Required - Polymorphic)
- `subject_type` (String, Required - Polymorphic)
- `action` (String, Required)
- `description` (Text, Nullable)
- `icon` (String, Nullable)
- `created_at`, `updated_at` (Timestamps)

### Pivot Tables

- `team_members` (team_id, user_id, role, status, joined_at)
- `project_members` (project_id, user_id, role, job_title)

## Installation

### Prerequisites

- PHP 8.3 or higher
- Composer 2.x
- Node.js 18+ & NPM
- MySQL 8.0+ or PostgreSQL 13+ or SQLite 3+

### Quick Setup

```bash
# Clone the repository
git clone https://github.com/abdullahdheir/task-management-app.git
cd task-management-app

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=focus
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# Build assets
npm run build

# Start development server
php artisan serve
```

### Development Mode

For a complete development environment with hot reload:

```bash
composer run dev
```

This starts:

- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite asset compiler

## Deployment

### Production Checklist

1. **Environment Configuration**

    ```bash
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://your-domain.com
    ```

2. **Optimization**

    ```bash
    # Cache configuration
    php artisan config:cache

    # Cache routes
    php artisan route:cache

    # Cache views
    php artisan view:cache

    # Optimize autoloader
    composer install --optimize-autoloader --no-dev
    ```

3. **Build Assets**

    ```bash
    npm run build
    ```

4. **Database Migrations**

    ```bash
    php artisan migrate --force
    ```

5. **Queue Worker Setup**

    ```bash
    # Using Supervisor (recommended)
    php artisan queue:work --tries=3 --timeout=90
    ```

6. **Cron Jobs**
    ```bash
    # Add to crontab
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
    ```

### Deployment Platforms

**Recommended:**

- Laravel Forge
- Vapor
- DigitalOcean (Laravel one-click)

**Manual Deployment:**

1. Deploy code to server
2. Configure web server (Nginx/Apache)
3. Set file permissions
4. Configure SSL certificate
5. Set up queue workers
6. Configure cron jobs

### Environment Variables

Required variables for production:

```env
APP_NAME=Focus
APP_ENV=production
APP_KEY=your-app-key
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=focus
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

QUEUE_CONNECTION=database
SESSION_DRIVER=database
CACHE_DRIVER=redis
```

## Usage

### Authentication Flow

1. **Registration**: Users can register via `/register` with email verification
2. **Login**: Standard login at `/login` with two-factor authentication support
3. **Password Reset**: Forgot password flow via `/forgot-password`
4. **Profile Management**: Update profile at `/profile`

### Task Management

1. **Create Task**: Navigate to `/tasks/create` or use the quick add button
2. **Task Organization**: Organize tasks by project, priority, or category
3. **Task Completion**: Mark tasks as complete with progress tracking
4. **Subtasks**: Create nested tasks for complex workflows
5. **Attachments**: Upload files to tasks for reference

### Project Collaboration

1. **Create Team**: Set up a team at `/teams/create`
2. **Invite Members**: Send invitations via email with role assignments
3. **Create Projects**: Organize work into projects within teams
4. **Assign Tasks**: Delegate tasks to team members
5. **Track Progress**: Monitor project completion through dashboards

### Dashboard Features

- **Weekly Progress**: Visual representation of weekly task completion
- **Category Breakdown**: Task distribution by category
- **Upcoming Deadlines**: Tasks due today and tomorrow
- **Recent Activity**: Latest actions across projects and teams

### Settings

- **Dark Mode**: Toggle between light and dark themes
- **Timezone**: Configure local timezone for accurate deadlines
- **Notifications**: Manage email and desktop alerts
- **Two-Factor Auth**: Enable/disable 2FA for enhanced security
- **Privacy**: Control data sharing preferences

## API Endpoints

### Authentication

- `GET /login` - Login page
- `POST /login` - Authenticate user
- `GET /register` - Registration page
- `POST /register` - Create new user
- `POST /logout` - Logout user

### Dashboard

- `GET /` - Redirect to dashboard
- `GET /dashboard` - Main dashboard

### Tasks

- `GET /tasks` - List user's tasks
- `GET /tasks/create` - Create task form
- `POST /tasks` - Store new task
- `GET /tasks/{task}` - Show task details
- `GET /tasks/{task}/edit` - Edit task form
- `PUT /tasks/{task}` - Update task
- `DELETE /tasks/{task}` - Delete task
- `POST /tasks/{task}/complete` - Mark task as complete
- `POST /tasks/{task}/subtasks` - Create subtask
- `GET /tasks/{task}/comments` - Get task comments

### Projects

- `GET /projects/overview` - List all projects
- `GET /projects/create` - Create project form
- `POST /projects` - Store new project
- `GET /projects/{project}` - Show project details
- `GET /projects/{project}/edit` - Edit project form
- `PUT /projects/{project}` - Update project
- `DELETE /projects/{project}` - Delete project
- `POST /projects/{project}/members` - Add project member
- `DELETE /projects/{project}/members/{user}` - Remove project member

### Teams

- `GET /teams/overview` - List all teams
- `GET /teams/create` - Create team form
- `POST /teams` - Store new team
- `GET /teams/{team}` - Show team details
- `GET /teams/{team}/edit` - Edit team form
- `PUT /teams/{team}` - Update team
- `DELETE /teams/{team}` - Delete team
- `POST /teams/{team}/invite` - Invite team member
- `POST /teams/{team}/accept` - Accept team invitation

### Comments & Attachments

- `POST /comments` - Store comment
- `DELETE /comments/{comment}` - Delete comment
- `POST /tasks/{task}/attachments` - Upload attachment
- `DELETE /attachments/{attachment}` - Delete attachment

### Search & Calendar

- `GET /search` - Global search
- `GET /search/users` - Search users
- `GET /calendar/{month?}` - Calendar view

### Profile & Settings

- `GET /profile` - Show profile
- `GET /profile/edit` - Edit profile form
- `PUT /profile` - Update profile
- `GET /settings` - Settings page
- `PUT /settings` - Update settings

## Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### Test Structure

- **Feature Tests**: Test HTTP endpoints and business logic
- **Unit Tests**: Test individual components and services
- **Browser Tests**: End-to-end testing (optional)

### Writing Tests

```php
// Example Feature Test
public function test_user_can_create_task()
{
    $user = User::factory()->create();
    $this->actingAs($user)
         ->post('/tasks', [
             'title' => 'Test Task',
             'priority' => 'high',
         ])
         ->assertRedirect('/tasks');

    $this->assertDatabaseHas('tasks', [
        'title' => 'Test Task',
        'user_id' => $user->id,
    ]);
}
```

## Contributing

### Guidelines

1. **Fork the repository**
2. **Create a feature branch**: `git checkout -b feature/amazing-feature`
3. **Commit your changes**: `git commit -m 'Add amazing feature'`
4. **Push to the branch**: `git push origin feature/amazing-feature`
5. **Open a Pull Request**

### Code Style

- Follow PSR-12 coding standards
- Use Laravel Pint for code formatting: `./vendor/bin/pint`
- Write descriptive commit messages
- Add comments for complex business logic
- Include tests for new features

### Development Workflow

1. Create issue for the feature/bug
2. Assign to yourself or request assignment
3. Create branch from `main`
4. Implement changes with tests
5. Run tests and ensure they pass
6. Submit pull request for review

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support, please:

- Open an issue on GitHub
- Contact the maintainers
- Check existing documentation

## Acknowledgments

- Built with [Laravel](https://laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Authentication by [Laravel Fortify](https://laravel.com/docs/fortify)
- Icons by [Material Symbols](https://fonts.google.com/icons)
