# DATABASE_DESIGN.md

# Database Design

## Project

Todo List App

## Database Engine

MySQL 8.x

Current Development Version:

MySQL 8.0.30

---

# Entity Relationship Diagram (ERD)

User
│
├── Category
│
└── Task

Relationships:

User 1 ---- N Categories

User 1 ---- N Tasks

Category 1 ---- N Tasks

Task N ---- 1 User

Task N ---- 0..1 Category

---

# Tables

## users

Provided by Laravel.

### Fields

| Column            | Type                  |
| ----------------- | --------------------- |
| id                | bigint                |
| name              | varchar(255)          |
| email             | varchar(255)          |
| email_verified_at | timestamp nullable    |
| password          | varchar(255)          |
| remember_token    | varchar(100) nullable |
| created_at        | timestamp             |
| updated_at        | timestamp             |

---

## categories

### Description

Stores user-defined task categories.

### Fields

| Column     | Type         | Null |
| ---------- | ------------ | ---- |
| id         | bigint       | no   |
| user_id    | bigint       | no   |
| name       | varchar(100) | no   |
| created_at | timestamp    | no   |
| updated_at | timestamp    | no   |

### Foreign Keys

user_id

references users(id)

on delete cascade

---

## tasks

### Description

Stores user tasks.

### Fields

| Column      | Type         | Null |
| ----------- | ------------ | ---- |
| id          | bigint       | no   |
| user_id     | bigint       | no   |
| category_id | bigint       | yes  |
| title       | varchar(255) | no   |
| description | text         | yes  |
| priority    | enum         | no   |
| status      | enum         | no   |
| due_date    | date         | yes  |
| created_at  | timestamp    | no   |
| updated_at  | timestamp    | no   |

---

# Enum Values

## priority

Allowed values:

* Low
* Medium
* High

Default:

Medium

---

## status

Allowed values:

* Pending
* Completed

Default:

Pending

---

# Foreign Keys

## tasks.user_id

references users(id)

on delete cascade

Meaning:

When a user is deleted,
all tasks belonging to that user are deleted.

---

## tasks.category_id

references categories(id)

on delete set null

Meaning:

When a category is deleted,
tasks remain but category_id becomes NULL.

---

# Index Strategy

## categories

INDEX

* user_id

---

## tasks

INDEX

* user_id
* category_id
* status
* priority
* due_date

---

# Eloquent Relationships

## User Model

```php
public function tasks()
{
    return $this->hasMany(Task::class);
}

public function categories()
{
    return $this->hasMany(Category::class);
}
```

## Category Model

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function tasks()
{
    return $this->hasMany(Task::class);
}
```

## Task Model

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class);
}
```

---

# Migration Requirements

## Categories Migration

Must include:

* foreignId('user_id')
* constrained()
* cascadeOnDelete()

---

## Tasks Migration

Must include:

* foreignId('user_id')
* constrained()
* cascadeOnDelete()

and

* foreignId('category_id')
* nullable()
* constrained()
* nullOnDelete()

---

# Data Ownership Rules

Every category belongs to exactly one user.

Every task belongs to exactly one user.

Users can only access:

* Their own tasks
* Their own categories

Cross-user access is prohibited.

---

# Seed Data

Development seed data may include:

Categories:

* Personal
* Study
* Work
* Organization

Priority:

* Low
* Medium
* High

Status:

* Pending
* Completed

---

# Future Database Changes

Not included in MVP:

* Teams Table
* Comments Table
* Notifications Table
* Attachments Table
* Activity Logs Table
* API Tokens
* Shared Tasks

These tables must not be created in Version 1.
