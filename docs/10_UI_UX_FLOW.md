# UI_UX_FLOW.md

# UI / UX Flow

## Project

Todo List App

## Version

1.0 MVP

---

# Design Principles

UI must be:

* Clean
* Minimal
* Responsive
* Beginner-friendly
* Productivity-focused

Avoid:

* Complex animations
* Fancy effects
* Over-designed interfaces

---

# Layout Structure

Authenticated pages use a shared layout.

Layout:

+--------------------------------------------------+
| Navbar                                           |
+--------------------------------------------------+
| Page Content                                     |
|                                                  |
|                                                  |
+--------------------------------------------------+

---

# Navigation

Navbar Items:

* Dashboard
* Tasks
* Categories
* Profile
* Logout

Desktop:

Horizontal Navigation

Mobile:

Hamburger Menu

---

# User Flow

Guest User

Login Page
↓
Login
↓
Dashboard

or

Register Page
↓
Register
↓
Dashboard

---

Authenticated User

Dashboard
↓
Tasks
↓
Create Task
↓
Save Task
↓
Task List

Dashboard
↓
Categories
↓
Create Category
↓
Save Category
↓
Category List

---

# Dashboard Page

URL:

/dashboard

Purpose:

Show productivity overview.

---

Components

+------------------------------------+
| Dashboard                          |
+------------------------------------+

+----------+----------+
| Total    | Complete |
+----------+----------+

+----------+----------+
| Pending  | Overdue  |
+----------+----------+

+------------------------------------+
| Recent Tasks                       |
+------------------------------------+

---

Statistics Cards

Display:

* Total Tasks
* Completed Tasks
* Pending Tasks
* Overdue Tasks

---

Recent Tasks Section

Show:

Latest 5 tasks

Columns:

* Title
* Priority
* Status
* Due Date

---

# Task List Page

URL:

/tasks

Purpose:

Manage tasks.

---

Layout

+--------------------------------------------------+
| Tasks                                      [+]   |
+--------------------------------------------------+

Search Bar

+----------------------------------------------+
| Search Tasks...                              |
+----------------------------------------------+

Filters

[Status]

[Priority]

[Category]

[Sort]

---

Task Table

+--------------------------------------------------+
| Title | Category | Priority | Status | Actions |
+--------------------------------------------------+

Actions:

* View
* Edit
* Delete

---

Empty State

No Tasks Found

Create your first task.

[Create Task]

---

# Create Task Page

URL:

/tasks/create

Purpose:

Create a new task.

---

Form

Title *

Description

Category

Priority *

Due Date

Status *

---

Buttons

[Save Task]

[Cancel]

---

Validation Errors

Display below each field.

---

Success Message

Task created successfully.

---

# Edit Task Page

URL:

/tasks/{task}/edit

Purpose:

Update task.

---

Form

Pre-filled with existing data.

Fields:

* Title
* Description
* Category
* Priority
* Due Date
* Status

Buttons:

[Update Task]

[Cancel]

---

Success Message

Task updated successfully.

---

# Task Detail Page

URL:

/tasks/{task}

Purpose:

View task information.

---

Display

Title

Description

Category

Priority

Status

Due Date

Created At

Updated At

---

Buttons

[Edit]

[Delete]

[Back]

---

# Categories Page

URL:

/categories

Purpose:

Manage categories.

---

Layout

+--------------------------------------+
| Categories                     [+]   |
+--------------------------------------+

Category Table

+--------------------+-----------+
| Name               | Actions   |
+--------------------+-----------+

Actions:

* Edit
* Delete

---

Empty State

No Categories Found

Create your first category.

[Create Category]

---

# Create Category Page

URL:

/categories/create

Purpose:

Create category.

---

Form

Category Name *

Buttons:

[Save]

[Cancel]

---

# Edit Category Page

URL:

/categories/{category}/edit

Purpose:

Update category.

---

Form

Category Name *

Buttons:

[Update]

[Cancel]

---

# Notifications

Use Laravel Session Flash Messages.

Success:

* Task Created
* Task Updated
* Task Deleted
* Category Created
* Category Updated
* Category Deleted

Error:

* Validation Error
* Unauthorized Action

---

# Colors

Use Tailwind default palette.

Status:

Pending

* Yellow Badge

Completed

* Green Badge

Priority:

Low

* Gray Badge

Medium

* Blue Badge

High

* Red Badge

---

# Responsive Rules

Desktop

> = 1024px

Use table layouts.

---

Tablet

768px - 1023px

Compress spacing.

---

Mobile

< 768px

Convert tables into stacked cards.

Hide non-essential columns.

---

# Accessibility Rules

All forms must have:

* Labels
* Validation messages
* Focus states

Buttons must be keyboard accessible.

---

# MVP Scope Reminder

Do NOT create:

* Dark Mode
* Kanban Board
* Calendar View
* Drag and Drop
* Team Workspace
* Notifications System
* File Upload
* Real-time Updates

These are out of scope for Version 1.0.
