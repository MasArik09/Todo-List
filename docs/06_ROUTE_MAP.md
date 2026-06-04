# ROUTE_MAP.md

# Public Routes

GET /login
name: login

GET /register
name: register

---

# Authenticated Routes

Middleware:

auth

---

# Dashboard

GET /dashboard
name: dashboard

controller:

DashboardController@index

---

# Categories

GET /categories
name: categories.index

controller:

CategoryController@index

GET /categories/create
name: categories.create

controller:

CategoryController@create

POST /categories
name: categories.store

controller:

CategoryController@store

GET /categories/{category}/edit
name: categories.edit

controller:

CategoryController@edit

PUT /categories/{category}
name: categories.update

controller:

CategoryController@update

DELETE /categories/{category}
name: categories.destroy

controller:

CategoryController@destroy

---

# Tasks

GET /tasks
name: tasks.index

controller:

TaskController@index

GET /tasks/create
name: tasks.create

controller:

TaskController@create

POST /tasks
name: tasks.store

controller:

TaskController@store

GET /tasks/{task}
name: tasks.show

controller:

TaskController@show

GET /tasks/{task}/edit
name: tasks.edit

controller:

TaskController@edit

PUT /tasks/{task}
name: tasks.update

controller:

TaskController@update

DELETE /tasks/{task}
name: tasks.destroy

controller:

TaskController@destroy

---

# Task Status

PATCH /tasks/{task}/complete
name: tasks.complete

controller:

TaskController@markCompleted

PATCH /tasks/{task}/pending
name: tasks.pending

controller:

TaskController@markPending
