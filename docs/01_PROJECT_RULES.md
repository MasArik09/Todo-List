# PROJECT_RULES.md

## Project Overview

This project is a portfolio-grade Todo List Application built using Laravel 13.

The objective is to demonstrate clean Laravel full-stack development skills while maintaining simplicity, maintainability, and adherence to Laravel best practices.

All development decisions must follow this document.

---

# Priority Order

When conflicts occur, follow this priority:

1. PROJECT_RULES.md
2. SRS.md
3. DATABASE_DESIGN.md
4. SYSTEM_DESIGN.md
5. PRD.md

Never violate a higher-priority document.

---

# Tech Stack

## Backend

* Laravel 13
* PHP 8.3+

## Database

* MySQL 8+

## Frontend

* Blade
* Tailwind CSS

## Authentication

* Laravel Breeze

---

# Architecture

Use standard Laravel MVC architecture.

Required layers:

* Models
* Controllers
* Form Requests
* Blade Views
* Migrations
* Seeders

Do not introduce custom architectures.

---

# Allowed Technologies

Only use:

* Laravel Core Features
* Laravel Breeze
* Blade
* Tailwind CSS
* Eloquent ORM
* Resource Controllers
* Route Model Binding
* Form Request Validation
* Laravel Policies (if authorization becomes necessary)

---

# Forbidden Technologies

Do NOT use:

- React
- Vue
- Angular
- Inertia
- Livewire
- Filament
- Nova
- Backpack

Alpine.js is allowed only as a Laravel Breeze dependency.

Do not build application features primarily with Alpine.js unless explicitly approved.

---

# Package Policy

The project follows a strict minimal dependency policy.

Allowed:

* Laravel Framework
* Laravel Breeze

Everything else requires explicit approval from the project owner.

Default assumption:

NO additional package installations are allowed.

---

# Banned Packages

The following packages are permanently prohibited:

* laravel-lang/lang
* laravel-lang/attributes
* laravel-lang/http-statuses
* laravel-lang/actions

AI agents must never:

* Recommend them
* Install them
* Depend on them
* Generate code that requires them

If localization is needed:

Use Laravel native language files only.

---

# Database Rules

Use Eloquent ORM.

Do not use raw SQL unless absolutely necessary.

All relationships must be explicitly defined.

Required relationships:

User hasMany Tasks

User hasMany Categories

Category hasMany Tasks

Task belongsTo User

Task belongsTo Category

---

# Authentication Rules

Authentication must use Laravel Breeze.

Users can only access their own data.

Never expose:

* Tasks from another user
* Categories from another user

Every query involving Tasks or Categories must be scoped to the authenticated user.

---

# Authorization Rules

All user-owned resources must be protected.

A user can:

* View own tasks
* Create own tasks
* Update own tasks
* Delete own tasks

A user cannot:

* Access another user's tasks
* Access another user's categories

---

# Controller Rules

Use Resource Controllers whenever appropriate.

Controllers must remain thin.

Controllers should:

* Receive request
* Call model/query logic
* Return response

Avoid business logic inside controllers.

---

# Validation Rules

Always use Form Request Validation.

Do NOT place validation directly inside controllers.

Examples:

* StoreTaskRequest
* UpdateTaskRequest
* StoreCategoryRequest
* UpdateCategoryRequest

---

# Model Rules

Each model must:

* Define fillable fields
* Define relationships
* Use Laravel conventions

Avoid unnecessary accessors, mutators, and traits.

Keep models simple.

---

# Routing Rules

Use named routes.

Group authenticated routes using auth middleware.

Use Route Model Binding whenever possible.

Route naming examples:

* tasks.index
* tasks.create
* tasks.store
* tasks.edit
* tasks.update
* tasks.destroy

---

# UI Rules

Use Blade Templates only.

Use Tailwind CSS only.

The UI must be:

* Clean
* Minimal
* Responsive
* Accessible
* Beginner-friendly

Avoid:

* Excessive animations
* Complex JavaScript
* Fancy UI libraries

---

# Responsive Design Rules

Support:

* Desktop
* Tablet
* Mobile

The application must remain usable on all screen sizes.

---

# Naming Conventions

## Models

Singular

Examples:

* User
* Task
* Category

## Database Tables

Plural

Examples:

* users
* tasks
* categories

## Controllers

Examples:

* TaskController
* CategoryController

## Form Requests

Examples:

* StoreTaskRequest
* UpdateTaskRequest

## Views

Examples:

* tasks/index.blade.php
* tasks/create.blade.php
* tasks/edit.blade.php

---

# Code Style Rules

Follow PSR standards.

Requirements:

* Meaningful variable names
* Small methods
* Small controllers
* DRY principle
* Readable code

Avoid:

* Duplicate code
* Dead code
* Unused imports
* Overengineering

---

# Feature Scope Rules

Implement ONLY features defined in PRD and SRS.

Do NOT implement:

* Team Collaboration
* Shared Tasks
* Comments
* Notifications
* Email Reminders
* Activity Logs
* Calendar View
* File Uploads
* Attachments
* Mobile Applications
* REST APIs
* Real-time Features
* Dark Mode

Unless explicitly requested by the project owner.

---

# Performance Rules

Prefer simple solutions.

Avoid:

* Premature optimization
* Complex caching strategies
* Unnecessary abstraction layers

The project is a portfolio application, not an enterprise-scale system.

---

# Security Rules

Passwords must always be hashed.

Never trust user input.

Always validate:

* Form input
* Route parameters

Protect against:

* Unauthorized access
* Mass assignment vulnerabilities

Use:

* Fillable properties
* CSRF protection
* Laravel validation

---

# Documentation Rules

Every feature implementation must include:

* Route
* Controller
* Form Request
* Model
* Migration
* Blade View

Maintain consistency across all modules.

---

# AI Agent Instructions

When generating code:

1. Follow PROJECT_RULES.md.
2. Follow SRS.md.
3. Follow DATABASE_DESIGN.md.
4. Follow SYSTEM_DESIGN.md.
5. Follow PRD.md.

Never:

* Add features outside scope.
* Install additional packages.
* Change architecture.
* Introduce forbidden technologies.

If uncertain:

Choose the simplest Laravel-native solution.

## Maintainability Rules

All UI must be componentized.

Use:

- Blade Components
- Blade Partials

Avoid:

- Large Blade files
- Duplicated forms
- Duplicated tables
- Duplicated alert messages

A Blade file exceeding 150 lines should be considered for refactoring.

Controllers exceeding 200 lines should be considered for refactoring.

Favor composition over duplication.

## Frontend Framework Policy

The project uses Tailwind CSS exclusively.

Do NOT use:

- Bootstrap
- Bulma
- Foundation
- Material UI
- Ant Design

All styling must use Tailwind CSS utilities.