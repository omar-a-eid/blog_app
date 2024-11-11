# Blog Application

A simple blog application built with Laravel, providing CRUD functionality for posts and comments. Users can create, edit, delete, and view posts, and add comments to each post. The application follows the MVC architecture and uses a repository pattern.

## Features

- CRUD operations for posts and comments
- Validation and error handling for forms
- Basic styling using Bootstrap
- Separate views for listing, creating, editing, and viewing posts and comments

## Prerequisites

- **PHP**: Ensure PHP (>= 8.0) is installed
- **Composer**: Install Composer for PHP dependency management
- **Node.js**: Install Node.js and npm for asset management
- **Database**: Set up a MySQL (or another preferred database)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/omar-a-eid/blog_app.git
   cd blog_app
  ```

2. **Install PHP dependencies**

  ```bash
   composer install
  ```

3. **Install JavaScript dependencies**

  ```bash
   npm install
  ```

4. **Environment setup**

  * Create a .env file by copying the .env.example file:
  ```bash
   cp .env.example .env
  ```

  * Update the .env file with your database credentials and any other necessary settings.


5. **Generate application key**

  ```bash
  php artisan key:generate
  ```

6. **Database setup**

* Run migrations to set up the database tables:
  ```bash
  php artisan migrate
  ```

### Running the Application

1. Start the Laravel development server:

  ```bash
  php artisan serve
  ```

2. Visit the application at http://localhost:8000.
