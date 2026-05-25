# Ink & Paper

A modern, minimalist blog platform built with Laravel, designed for writers who value clarity and focus. The platform provides a distraction-free writing environment with a clean, elegant interface inspired by the principles of digital quiet.

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## Features

- **Distraction-Free Writing Editor**: Clean, minimalist interface designed for focused content creation
- **Category Management**: Organize content with a flexible category system with slug support
- **Modern UI/UX**: Built with Tailwind CSS and Material Design principles
- **Responsive Design**: Fully responsive layout that works seamlessly across all devices
- **SEO-Friendly**: Built-in slug generation and SEO metadata support
- **Dashboard Analytics**: Track post performance and engagement metrics
- **Draft Management**: Save and manage drafts before publishing

## Technology Stack

- **Backend**: Laravel 13.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Icons**: Google Material Symbols
- **Fonts**: Inter (UI), Source Serif 4 (Body/Display)

## Installation

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js & NPM (for asset compilation)
- MySQL or PostgreSQL

### Setup Instructions

1. **Clone the repository**

    ```bash
    git clone https://github.com/abdullahdheir/sass-blog.git
    cd sass-blog
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
    DB_DATABASE=ink_and_paper
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
│   │       ├── CategoryController.php
│   │       ├── PageController.php
│   │       └── PostController.php
│   └── Models/
│       ├── Category.php
│       └── Post.php
├── database/
│   └── migrations/
│       ├── 2026_05_24_035439_create_categories_table.php
│       └── 2026_05_24_035609_create_posts_table.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── dashboard.blade.php
│   │   │   └── public.blade.php
│   │   ├── categories/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   └── posts/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       ├── edit.blade.php
│   │       └── show.blade.php
└── routes/
    └── web.php
```

## Database Schema

### Categories Table

- `id` (Primary Key)
- `name` (String, Required)
- `slug` (String, Unique, Required)
- `description` (Text, Nullable)
- `created_at`, `updated_at` (Timestamps)

### Posts Table

- `id` (Primary Key)
- `title` (String, Required)
- `content` (Text, Required)
- `category_id` (Foreign Key, Nullable)
- `created_at`, `updated_at` (Timestamps)

## Usage

### Managing Categories

1. Navigate to `/categories` to view all categories
2. Click "Create Category" to add a new category
3. Fill in the name, slug, and optional description
4. Edit or delete categories from the management view

### Managing Posts

1. Navigate to `/posts` to view the dashboard
2. Click "Write a post" to create a new post
3. Enter the title, select a category, and write your content
4. Publish your post or save as a draft
5. Edit or delete posts from the dashboard

## Design System

The platform uses a custom design system based on Material Design 3 principles:

- **Color Palette**: Purple primary with neutral surface colors
- **Typography**: Source Serif 4 for headings and body text, Inter for UI elements
- **Spacing**: Consistent spacing scale for visual rhythm
- **Components**: Reusable Blade components for consistency

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

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For support, please open an issue on GitHub or contact the maintainers.

## Acknowledgments

- Built with [Laravel](https://laravel.com)
- Styled with [Tailwind CSS](https://tailwindcss.com)
- Icons by [Google Material Symbols](https://fonts.google.com/icons)
- Fonts by [Google Fonts](https://fonts.google.com)
