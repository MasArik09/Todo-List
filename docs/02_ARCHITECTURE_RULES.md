# FILE_ORGANIZATION_RULES

## General Principle

Prefer small focused files.

Avoid large files with multiple responsibilities.

---

# Controller Rules

Controllers should remain thin.

Recommended:

Maximum:

* 7 methods per controller
* 200 lines per controller

If complexity grows:

Extract logic.

---

# Blade Rules

Views must be split into reusable partials.

Bad:

tasks/index.blade.php

contains:

* page layout
* search form
* filters
* table
* empty state
* pagination

in one file.

Good:

tasks/index.blade.php

includes:

tasks/partials/search-form.blade.php

tasks/partials/filter-bar.blade.php

tasks/partials/task-table.blade.php

tasks/partials/empty-state.blade.php

tasks/partials/pagination.blade.php

---

# Reusable Components

Repeated UI should become Blade Components.

Examples:

resources/views/components/

badge.blade.php

button.blade.php

card.blade.php

alert.blade.php

table.blade.php

---

# Dashboard Rules

Dashboard widgets should be separated.

Example:

dashboard/index.blade.php

includes:

dashboard/partials/stat-cards.blade.php

dashboard/partials/recent-tasks.blade.php

---

# Form Rules

Forms should be reusable.

Example:

tasks/create.blade.php

tasks/edit.blade.php

should reuse:

tasks/partials/form.blade.php

Avoid duplicated forms.

---

# Query Rules

Complex queries should not be placed directly inside Blade.

Bad:

@foreach(Task::where(...))

Good:

Controller prepares data.

Blade only renders data.

---

# Business Logic Rules

Business logic must not exist inside Blade.

Business logic must not exist inside routes.

Keep logic in:

* Controllers
* Services (if approved)

---

# File Size Limits

Recommended limits:

Controller:

< 200 lines

Model:

< 150 lines

Blade:

< 150 lines

Form Request:

< 100 lines

If limits are exceeded:

Refactor.

---

# Single Responsibility Rule

Each file should have one purpose.

Examples:

TaskController

Task CRUD only.

DashboardController

Dashboard only.

CategoryController

Category CRUD only.

Do not mix responsibilities.

---

# AI Agent Instruction

When creating a new file:

Ask:

"Can this responsibility be reused elsewhere?"

If yes:

Create a partial or component.

Avoid monolithic files.

# ARCHITECTURE_RULES.md

# Purpose

This document defines code organization, maintainability standards, and architectural boundaries.

All generated code must follow these rules.

---

# Core Principles

1. Small files.
2. Single Responsibility Principle.
3. Reusable components.
4. Avoid duplication.
5. Maintainable structure.
6. Laravel Convention First.

---

# File Organization Rules

Each file should have one responsibility only.

Avoid monolithic files.

Bad:

* One controller handling multiple modules.
* One Blade file containing an entire page ecosystem.
* One model containing unrelated business logic.

Good:

* Separate controllers.
* Separate Blade partials.
* Reusable components.

---

# Controller Architecture

Controllers should remain thin.

Responsibilities:

* Receive request
* Call model/query logic
* Return response

Avoid:

* Complex calculations
* Large business workflows
* Multiple unrelated responsibilities

Recommended limits:

* Maximum 7 methods
* Maximum 200 lines

If exceeded:

Refactor.

---

# Blade Architecture

Blade files must be modular.

Never place an entire page implementation inside a single file.

---

# Required Blade Structure

resources/views/

layouts/
components/
dashboard/
tasks/
categories/

---

# Shared Components

resources/views/components/

Examples:

* button.blade.php
* badge.blade.php
* card.blade.php
* alert.blade.php
* modal.blade.php

Reusable UI belongs here.

---

# Dashboard Structure

dashboard/

index.blade.php

partials/

* stat-cards.blade.php
* recent-tasks.blade.php

---

# Task Structure

tasks/

index.blade.php

create.blade.php

edit.blade.php

show.blade.php

partials/

* form.blade.php
* search-bar.blade.php
* filter-bar.blade.php
* task-table.blade.php
* empty-state.blade.php

---

# Category Structure

categories/

index.blade.php

create.blade.php

edit.blade.php

partials/

* form.blade.php
* category-table.blade.php

---

# Form Reusability

Create and Edit pages must share form partials.

Example:

tasks/create.blade.php

tasks/edit.blade.php

Both must use:

tasks/partials/form.blade.php

Avoid duplicated forms.

---

# View Responsibilities

Blade should only render data.

Avoid:

* Query execution
* Business logic
* Complex calculations

Bad:

@foreach(Task::where(...))

Good:

Controller prepares data.

Blade renders data.

---

# Component Rules

If UI is reused 2+ times:

Convert to component.

Examples:

* Alert
* Badge
* Button
* Card
* Empty State

---

# Model Rules

Models should contain:

* Relationships
* Scopes (when appropriate)
* Simple helper methods

Avoid:

* Large business workflows
* Massive utility methods

Recommended limit:

150 lines

---

# Query Rules

Use Eloquent relationships.

Prefer:

$user->tasks()

Over:

Manual joins.

---

# Route Rules

Keep route files clean.

Avoid:

Anonymous route logic.

Bad:

Route::get('/tasks', function () {
...
});

Good:

Route::resource(...)

---

# Reusability Rules

Extract repeated logic.

Examples:

Repeated Form

→ Partial

Repeated UI

→ Component

Repeated Query

→ Scope

Repeated Workflow

→ Service (requires approval)

---

# File Size Guidelines

Controller

Target:

< 200 lines

Model

Target:

< 150 lines

Blade

Target:

< 150 lines

Form Request

Target:

< 100 lines

---

# Future Growth Rules

The architecture must support future additions without major restructuring.

Potential future modules:

* Notifications
* Activity Logs
* Shared Tasks

Current implementation should not block future expansion.

---

# AI Agent Instructions

Before creating code:

Ask:

1. Can this be reused?
2. Should this become a component?
3. Should this become a partial?
4. Is this file becoming too large?

If yes:

Refactor immediately.

Prefer maintainability over speed of generation.
