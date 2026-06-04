# SRS.md

# Software Requirements Specification

## Project Name

Todo List App

## Version

1.0 MVP

## Technology Stack

* Laravel 13
* PHP 8.3+
* MySQL 8+
* Blade
* Tailwind CSS
* Laravel Breeze

---

# 1. Actors

## User

Authenticated user who manages personal tasks and categories.

Permissions:

* Create tasks
* Read tasks
* Update tasks
* Delete tasks
* Create categories
* Read categories
* Update categories
* Delete categories
* View dashboard

Restrictions:

* Cannot access another user's data

---

# 2. Modules

## Authentication Module

### Features

* Register
* Login
* Logout

Provided by Laravel Breeze.

No customization required in MVP.

---

## Dashboard Module

### Purpose

Provide a summary of user productivity.

### Statistics

Display:

* Total Tasks
* Completed Tasks
* Pending Tasks
* Overdue Tasks

### Rules

Overdue Task:

* Status = Pending
* Due Date < Current Date

---

## Category Module

### Purpose

Organize tasks into categories.

### Fields

| Field | Type   | Required |
| ----- | ------ | -------- |
| name  | string | yes      |

### Validation Rules

name:

* required
* string
* max:100

### Functional Requirements

User can:

* Create category
* View category list
* Edit category
* Delete category

### Business Rules

BR-CAT-01

Category belongs to one user.

BR-CAT-02

Users can only view their own categories.

BR-CAT-03

Category names do not need to be unique.

BR-CAT-04

Deleting a category must not delete tasks.

BR-CAT-05

When category is deleted:

category_id on related tasks becomes NULL.

---

## Task Module

### Purpose

Manage personal tasks.

### Fields

| Field       | Type        | Required |
| ----------- | ----------- | -------- |
| title       | string      | yes      |
| description | text        | no       |
| category_id | foreign key | no       |
| priority    | enum        | yes      |
| status      | enum        | yes      |
| due_date    | date        | no       |

---

### Priority Values

* Low
* Medium
* High

---

### Status Values

* Pending
* Completed

---

### Validation Rules

title

* required
* string
* max:255

description

* nullable

category_id

* nullable
* exists:categories,id

priority

* required
* in:Low,Medium,High

status

* required
* in:Pending,Completed

due_date

* nullable
* date

---

### Functional Requirements

User can:

* Create task
* View task list
* View task details
* Edit task
* Delete task
* Mark task completed
* Mark task pending

---

### Business Rules

BR-TASK-01

Task belongs to one user.

BR-TASK-02

Task may belong to one category.

BR-TASK-03

Category is optional.

BR-TASK-04

Due date is optional.

BR-TASK-05

Users can only access their own tasks.

BR-TASK-06

Newly created tasks must have default status:

Pending

BR-TASK-07

Tasks should be ordered by latest created date by default.

---

# 3. Search Functionality

### Search Target

Task Title

### Rules

* Case insensitive
* Partial match supported

Examples:

Searching:

exam

Should match:

* Math Exam
* Final Exam
* Exam Preparation

---

# 4. Filter Functionality

User can filter tasks by:

## Status

Values:

* Pending
* Completed

## Priority

Values:

* Low
* Medium
* High

## Category

Values:

* User-owned categories

Filters may be combined.

---

# 5. Sorting Functionality

Supported sorting:

* Newest First
* Oldest First
* Due Date Ascending
* Due Date Descending

Default:

Newest First

---

# 6. Pages

## Guest Pages

### Login

URL:

/login

### Register

URL:

/register

---

## Authenticated Pages

### Dashboard

URL:

/dashboard

---

### Task List

URL:

/tasks

---

### Create Task

URL:

/tasks/create

---

### Edit Task

URL:

/tasks/{id}/edit

---

### Category List

URL:

/categories

---

### Create Category

URL:

/categories/create

---

### Edit Category

URL:

/categories/{id}/edit

---

### Profile

Provided by Laravel Breeze.

---

# 7. Acceptance Criteria

## Create Task

Success when:

* Title entered
* Validation passes
* Task saved
* Task visible in task list

Failure when:

* Title empty

---

## Update Task

Success when:

* Existing task updated
* Changes visible immediately

Failure when:

* Task belongs to another user

---

## Delete Task

Success when:

* Task removed from database
* Task removed from list

Failure when:

* Task belongs to another user

---

## Create Category

Success when:

* Name entered
* Validation passes
* Category appears in category list

Failure when:

* Name empty

---

# 8. Security Requirements

Users must only access their own data.

Every query involving:

* Tasks
* Categories

Must be scoped to:

authenticated user.

Unauthorized access must return:

403 Forbidden

or

404 Not Found

according to implementation preference.

---

# 9. Future Scope

Not included in MVP:

* Team Collaboration
* Shared Tasks
* Notifications
* Email Reminder
* Activity Log
* File Upload
* Mobile App
* REST API
* Dark Mode
