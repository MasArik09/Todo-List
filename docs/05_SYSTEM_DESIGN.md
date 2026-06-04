# SYSTEM_DESIGN.md

# System Design

## Project

Todo List App

## Version

1.0 MVP

## Technology Stack

Backend:

* Laravel 13
* PHP 8.3+

Frontend:

* Blade
* Tailwind CSS

Database:

* MySQL 8.x

Authentication:

* Laravel Breeze

Architecture:

* MVC (Model View Controller)

---

# High Level Architecture

User
↓
Routes
↓
Controllers
↓
Models
↓
Database

Controllers
↓
Blade Views
↓
User Interface

---

# Application Modules

## Authentication Module

Provided by Laravel Breeze.

Features:

* Register
* Login
* Logout
* Profile Management

---

## Dashboard Module

Responsibilities:

* Display statistics
* Display productivity summary

Controller:

DashboardController

---

## Category Module

Responsibilities:

* Create category
* Read category
* Update category
* Delete category

Controller:

CategoryController

Model:

Category

Requests:

* StoreCategoryRequest
* UpdateCategoryRequest

Views:

* categories/index.blade.php
* categories/create.blade.php
* categories/edit.blade.php

---

## Task Module

Responsibilities:

* Create task
* Read task
* Update task
* Delete task
* Change task status

Controller:

TaskController

Model:

Task

Requests:

* StoreTaskRequest
* UpdateTaskRequest

Views:

* tasks/index.blade.php
* tasks/create.blade.php
* tasks/edit.blade.php
* tasks/show.blade.php

---

# Folder Structure

app/

├── Http/

│   ├── Controllers/

│   │   ├── DashboardController.php

│   │   ├── CategoryController.php

│   │   └── TaskController.php

│   │

│   └── Requests/

│       ├── StoreCategoryRequest.php

│       ├── UpdateCategoryRequest.php

│       ├── StoreTaskRequest.php

│       └── UpdateTaskRequest.php

│

├── Models/

│   ├── User.php

│   ├── Category.php

│   └── Task.php

resources/

└── views/

```
├── dashboard/

│   └── index.blade.php

│

├── categories/

│   ├── index.blade.php

│   ├── create.blade.php

│   └── edit.blade.php

│

└── tasks/

    ├── index.blade.php

    ├── create.blade.php

    ├── edit.blade.php

    └── show.blade.php
```

---

# Models

## User

Relationships:

* hasMany Tasks
* hasMany Categories

---

## Category

Relationships:

* belongsTo User
* hasMany Tasks

Fields:

* id
* user_id
* name

---

## Task

Relationships:

* belongsTo User
* belongsTo Category

Fields:

* id
* user_id
* category_id
* title
* description
* priority
* status
* due_date

---

# Controllers

## DashboardController

Responsibilities:

* Calculate statistics
* Return dashboard view

Methods:

* index()

---

## CategoryController

Methods:

* index()
* create()
* store()
* edit()
* update()
* destroy()

---

## TaskController

Methods:

* index()
* create()
* store()
* show()
* edit()
* update()
* destroy()

Additional Methods:

* markCompleted()
* markPending()

---

# Request Validation Classes

## StoreCategoryRequest

Validation:

name

* required
* string
* max:100

---

## UpdateCategoryRequest

Validation:

name

* required
* string
* max:100

---

## StoreTaskRequest

Validation:

title

* required
* max:255

priority

* required

status

* required

category_id

* nullable

due_date

* nullable
* date

---

## UpdateTaskRequest

Same validation as StoreTaskRequest.

---

# Route Design

## Public Routes

GET /login

GET /register

---

## Authenticated Routes

Middleware:

auth

---

Dashboard

GET /dashboard

name:

dashboard

---

Categories

GET /categories

GET /categories/create

POST /categories

GET /categories/{category}/edit

PUT /categories/{category}

DELETE /categories/{category}

---

Tasks

GET /tasks

GET /tasks/create

POST /tasks

GET /tasks/{task}

GET /tasks/{task}/edit

PUT /tasks/{task}

DELETE /tasks/{task}

---

Task Status

PATCH /tasks/{task}/complete

PATCH /tasks/{task}/pending

---

# View Design

## Layout

Shared Layout:

resources/views/layouts/app.blade.php

---

Navigation

Links:

* Dashboard
* Tasks
* Categories
* Profile
* Logout

---

# Error Handling

Validation errors:

Display below form fields.

Authorization errors:

Return 403.

Missing resources:

Return 404.

---

# Authorization Design

Every query involving:

* Task
* Category

Must be scoped to:

Authenticated User.

Example:

Users can only:

* View own records
* Update own records
* Delete own records

Users cannot:

* Access another user's records.

---

# Future Modules

Excluded from MVP:

* Notifications
* Team Workspace
* Shared Tasks
* File Attachments
* Activity Logs
* REST API
* Mobile App

These modules must not be implemented.
