# CODING_STANDARDS.md

# General Rules

Follow Laravel conventions.

Prefer readability over clever code.

Keep implementation simple.

---

# Controllers

Controllers must remain thin.

Allowed:

* Validation handling
* Model interaction
* Returning views

Avoid:

* Complex business logic
* Large methods

Maximum recommendation:

100 lines per controller.

---

# Methods

One method should perform one responsibility.

Examples:

Good:

* store()
* update()
* destroy()

Bad:

* storeAndNotifyAndLog()

---

# Form Requests

Always use Form Request Validation.

Never place validation rules directly inside controllers.

Required:

* StoreTaskRequest
* UpdateTaskRequest
* StoreCategoryRequest
* UpdateCategoryRequest

---

# Queries

Always scope data to authenticated user.

Good:

Task::where('user_id', auth()->id())

Bad:

Task::all()

---

# Eloquent

Prefer Eloquent relationships.

Good:

$user->tasks()

Bad:

Manual joins when relationships already exist.

---

# Views

Blade only.

Use reusable partials when necessary.

Examples:

resources/views/components/

resources/views/partials/

---

# Tailwind

Use Tailwind utility classes.

Avoid custom CSS unless necessary.

Avoid inline styles.

Bad:

style="color:red"

---

# Naming

Variables:

camelCase

Methods:

camelCase

Classes:

PascalCase

Tables:

snake_case plural

Columns:

snake_case

---

# Flash Messages

Use session flash messages.

Examples:

success

error

warning

Do not create custom notification systems.

---

# Authorization

Before update/delete:

Verify resource ownership.

Users must never modify another user's data.

---

# Database

Use migrations.

Never modify tables manually through phpMyAdmin.

All schema changes must be tracked via migration files.

---

# Error Handling

Use Laravel validation messages.

Use 404 for missing resources.

Use 403 for unauthorized actions.

Avoid exposing system errors to users.

---

# Code Duplication

Avoid copy-paste code.

Extract reusable logic when duplication appears.

---

# Documentation

Every feature should have:

* Route
* Controller
* Request
* View
* Model relationship

Implementation must remain consistent.
