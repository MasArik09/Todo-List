# Product Requirements Document (PRD)

## Project Information

### Project Name

Todo List App

### Version

1.0 MVP

### Tech Stack

* Laravel 13
* PHP 8.3+
* MySQL 8+
* Blade
* Tailwind CSS
* Laravel Breeze

---

# Product Overview

Todo List App adalah aplikasi manajemen tugas berbasis web yang membantu pengguna mengelola pekerjaan, tugas kuliah, dan aktivitas pribadi secara sederhana dan efisien.

Target pengguna:

* Mahasiswa
* Personal Productivity User
* Tim Kecil

---

# Goals

## Business Goals

* Menjadi project portfolio Laravel Fullstack.
* Menunjukkan implementasi Authentication.
* Menunjukkan implementasi CRUD.
* Menunjukkan implementasi Relational Database.
* Menunjukkan implementasi Search dan Filter.

## User Goals

* Mencatat tugas.
* Mengatur prioritas tugas.
* Mengelompokkan tugas berdasarkan kategori.
* Memantau progres tugas.
* Mengetahui tugas yang mendekati deadline.

---

# In Scope

## Authentication

* Register
* Login
* Logout

## Dashboard

* Total Tasks
* Completed Tasks
* Pending Tasks
* Overdue Tasks

## Task Management

* Create Task
* View Task
* Edit Task
* Delete Task
* Mark Completed
* Mark Pending

## Category Management

* Create Category
* View Category
* Edit Category
* Delete Category

## Search & Filter

* Search by Title
* Filter by Status
* Filter by Category
* Filter by Priority
* Sort by Due Date

## Responsive UI

* Desktop
* Tablet
* Mobile

---

# Out Of Scope

Tidak boleh dibuat pada versi 1.

* Team Collaboration
* Shared Tasks
* Comments
* Notifications
* Email Reminder
* REST API
* Mobile Application
* Dark Mode
* Activity Log
* File Upload
* Attachment
* Calendar View

---

# User Roles

## User

Hak akses:

* Mengelola task milik sendiri.
* Mengelola kategori milik sendiri.
* Melihat dashboard milik sendiri.

Tidak dapat:

* Mengakses data user lain.

---

# Core Features

## Task

Field:

* Title
* Description
* Category
* Priority
* Due Date
* Status

Priority:

* Low
* Medium
* High

Status:

* Pending
* Completed

---

## Category

Field:

* Name

Contoh:

* Kuliah
* Organisasi
* Pribadi
* Kerja

---

# User Stories

As a user,
I want to create a task,
so that I can track my work.

As a user,
I want to edit a task,
so that task information remains updated.

As a user,
I want to complete a task,
so that I can monitor my productivity.

As a user,
I want to assign a category,
so that tasks are organized.

As a user,
I want to filter tasks,
so that I can find tasks quickly.

---

# Success Criteria

User can:

* Register account.
* Login successfully.
* Create task.
* Edit task.
* Delete task.
* Complete task.
* Manage categories.
* Search task.
* Filter task.

System can:

* Protect user data.
* Prevent unauthorized access.
* Load pages under 2 seconds in local environment.

---

# Release Target

Version 1.0 MVP

Features included:

* Authentication
* Dashboard
* Task CRUD
* Category CRUD
* Search
* Filter
* Responsive Design
