# Todo List App

A portfolio-grade, secure, and clean Todo List Web Application built with Laravel 13, Tailwind CSS, and MySQL.

This application is designed to demonstrate modern PHP/Laravel development best practices, standard MVC architecture, robust security hardening against common vulnerabilities, and component-based Blade front-end design.

---

## 🚀 Features

* **Authentication**: Secure user authentication (Register, Login, Logout, and Profile Management) provided by Laravel Breeze.
* **Dashboard Summary**: A productivity-oriented dashboard displaying:
  * Key metrics: Total Tasks, Completed Tasks, Pending Tasks, and Overdue Tasks (tasks with a `Pending` status and a due date in the past).
  * Completion Progress: Visual indicator representing the percentage of completed tasks.
  * Recent Tasks: Quick overview of the latest 5 tasks.
  * Quick Actions: Direct links to create tasks and categories.
* **Task Management**: Full CRUD operations for personal tasks.
  * Task fields: Title, description (optional), category (optional), priority (Low, Medium, High), status (Pending, Completed), and due date (optional).
  * Task Status Toggle: Inline actions to easily mark tasks as complete or pending.
* **Category Management**: Create, view, edit, and delete categories to organize tasks.
  * Clean cascade handling: Deleting a category automatically nullifies the category field on related tasks (no cascading deletions of tasks).
* **Search & Filters**: Highly responsive task retrieval:
  * Case-insensitive partial search by task title.
  * Multi-select filters for Category, Priority, and Status.
  * Quick-filter toggle for overdue tasks.
  * Reset filters control to clear query states instantly.
  * Parameter preservation across pagination (10 items per page).
* **Security & Isolation**: Strict user-level data isolation. Users can only access and modify their own tasks and categories.
* **Responsive UI/UX**: Standardized form inputs, badges, alert banners, and empty-state illustrations built with Tailwind CSS.

---

## 📸 Screenshots

*(Placeholder Section: UI previews will be added here)*
| Dashboard | Task List |
|---|---|
| ![Dashboard Mockup](https://via.placeholder.com/600x400?text=Dashboard+UI) | ![Task List Mockup](https://via.placeholder.com/600x400?text=Task+List+UI) |

---

## 🛠️ Tech Stack

* **Backend**: Laravel 13, PHP 8.3+
* **Frontend**: Blade Templates, Tailwind CSS, Vite
* **Database**: MySQL 8.0+
* **Authentication**: Laravel Breeze
* **Testing**: PHPUnit, Laravel Feature Tests

---

## 🏗️ Architecture Overview

The project adheres strictly to standard Laravel MVC conventions and follows the guidelines outlined in the repository's architecture documentation:

* **Resource Controllers**: Controllers are kept thin, containing only requests routing and model scoping.
* **Form Requests**: Form validation rules are offloaded from controllers into specialized form requests (e.g., `StoreTaskRequest`, `UpdateTaskRequest`).
* **Eloquent Scopes & Scoped Queries**: All database operations are scoped to the authenticated user model (`$request->user()->tasks()`), eliminating the risk of cross-user data leakage.
* **Blade Components & Partials**: UI elements (badges, alert boxes, textareas, select inputs, and empty states) are extracted into reusable components (`resources/views/components/`) to maintain DRY compliance.

---

## 🤖 AI-Assisted Development Disclosure

This project was built using a hybrid **AI-Assisted Software Engineering Workflow**:

1. **Structured Engineering Specification**: Prior to code generation, detailed software engineering specifications were created, including a Product Requirement Document (PRD), Software Requirement Specification (SRS), Route Map, Database Design, System Architecture Rules, and UI/UX Flow.
2. **AI Planning & Architecture Guidance**: **ChatGPT** was utilized to review design proposals, audit specifications, and plan implementation sequences.
3. **Execution Agent**: The **Antigravity AI Agent** acted as an automated software engineer, translating the specifications into clean Laravel PHP and Blade components, performing code refactoring, styling via Pint, and running test validations.
4. **Human Direction**: Every stage was closely directed, reviewed, and approved by a human developer. The project was not "automatically generated" in a single click, but rather built through disciplined, interactive pair programming with AI tools to achieve production-grade quality.

---

## 📥 Installation Guide

Follow these steps to set up the project locally:

### 1. Prerequisites
Ensure you have the following installed on your machine:
* PHP 8.3 or higher
* Composer
* Node.js & NPM
* MySQL Server

### 2. Clone and Setup Dependencies
```bash
# Clone the repository
git clone https://github.com/MasArik09/Todo-List.git
cd Todo-List

# Install composer packages
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Setup
```bash
# Create the environment configuration file
cp .env.example .env

# Generate the application key
php artisan key:generate
```

### 4. Database Setup
Create a MySQL database named `todo_list` (and a database `todo_list_test` for running tests if desired). Update your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_list
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run database migrations:
```bash
php artisan migrate
```

### 5. Running the Project
Compile the frontend assets:
```bash
npm run build
# OR start the Vite development server
npm run dev
```

Start the Laravel local development server:
```bash
php artisan serve
```
The application will be accessible at `http://127.0.0.1:8000`.

---

## 🧪 Running Tests

The application features a complete suite of integration and feature tests verifying authentication, ownership validation, task management, category handling, and search/filter logic.

To run the test suite:
```bash
php artisan test
```

---

## 📂 Project Structure

Below is an overview of the key directories containing custom logic:
```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CategoryController.php   # Category CRUD
│   │   │   ├── DashboardController.php  # Productivity Dashboard
│   │   │   └── TaskController.php       # Task CRUD & Filtering
│   │   └── Requests/
│   │       ├── StoreCategoryRequest.php
│   │       ├── StoreTaskRequest.php
│   │       ├── UpdateCategoryRequest.php
│   │       └── UpdateTaskRequest.php
│   └── Models/
│       ├── Category.php                 # Relational category model
│       ├── Task.php                     # Relational task model
│       └── User.php                     # User model
├── database/
│   └── migrations/                      # Schema migrations for users, tasks, and categories
├── resources/
│   └── views/
│       ├── components/                  # Reusable Blade UI components (badge, alert, empty-state, etc.)
│       ├── dashboard/                   # Dashboard view views
│       ├── categories/                  # Category CRUD views
│       └── tasks/                       # Task CRUD, search, and table views
└── tests/
    └── Feature/                         # Comprehensive feature tests
```

---

## 🔒 Security Notes

The application has been hardened against common web application vulnerabilities (refer to the full Security Audit Report for details):
* **IDOR (Insecure Direct Object Reference) Protection**: Strictly checks that all resources being requested, updated, deleted, or categorized belong to the authenticated user. Ownership is enforced at the controller query layer.
* **SQL Injection Mitigation**: Uses Eloquent parameter binding across all search and query builder operations.
* **Input Type-Safety & Validation**: Enforces request validation on GET query filters (`search`, `status`, `priority`, `category_id`, `overdue`) within the `TaskController@index` method, eliminating potential array-injection bugs or type-safety errors.
* **Mass-Assignment Protection**: Excluded `'user_id'` from the `$fillable` array in both the `Task` and `Category` models. Foreign keys are only set programmatically via user relationship builders in the controllers.
* **XSS Mitigation**: Standardized on Blade double-braces `{{ }}` for all dynamic output, preventing script injection.

---

## 🔮 Future Improvements

Potential features scoped for post-MVP releases:
* **Task Reminders**: Browser notifications or email alerts for overdue or upcoming tasks.
* **Due Date Alerts**: Visual highlight and dashboard alert banner when a task is due in less than 24 hours.
* **Activity Logs**: Track changes to tasks and categories for auditing productivity.
* **Tagging System**: Add support for multi-tag filtering on tasks.

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](LICENSE).

---

## 👤 Author

* **MasArik09** - Lead Developer & Project Architect
