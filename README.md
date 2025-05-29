# ToDo List API

A RESTful API built with Laravel to allow each user to manage their own task list. The API supports user registration, authentication, creating tasks, listing them, updating status, deleting tasks, and filtering by status.

---

## Features

- User registration and login using Laravel Sanctum
- Create task (title and optional description)
- List all tasks for the authenticated user
- Update task status (pending, in_progress, completed, cancelled)
- Delete a task
- Filter tasks by status
- Unit and integration tests using in-memory SQLite
- API documentation using Swagger (OpenAPI)

---

## Getting Started

### Requirements

- PHP 8.2 or higher
- Composer
- Laravel 12
- Git
- SQLite (used for automated tests)

---

## Installation

Clone the repository and install dependencies:

```bash
git clone https://github.com/jonasportugall/To-Do-List-API.git
cd to-do-list-api
composer install
cp .env.example .env (in linux) ou copy .env.example .env (in windows)
php artisan key:generate
```

---

## Configuration

Update the `.env` file with your preferred database settings. Example for MySQL:

```
DB_CONNECTION=mysql
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

---

## Migrate the Database

Run the following command to create the necessary tables:

```bash
php artisan migrate
```

---

## Run the Server

```bash
php artisan serve
```

By default, the API will be accessible at:

```
http://localhost:8000
```

---

## Authentication

This API uses **Laravel Sanctum** for authentication.

To interact with protected endpoints, you must register and log in to obtain a token. Use this token in the `Authorization` header of your requests.

```
Authorization: Bearer YOUR_TOKEN
```

---

## API Endpoints

### Authentication

| Method | Endpoint       | Description           |
|--------|----------------|-----------------------|
| POST   | /api/register  | Register a new user   |
| POST   | /api/login     | Login and get token   |

#### Register

- **Method**: `POST`
- **URL**: `/api/register`
- **Body**:
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret",
  "password_confirmation": "secret"
}
```

#### Login

- **Method**: `POST`
- **URL**: `/api/login`
- **Body**:
```json
{
  "email": "john@example.com",
  "password": "secret"
}
```

**Response**:
```json
{
    "user": {
        "id": "4e99b4c8-8de4-4b46-b722-641382f1b27c",
        "name": "John Doe",
        "email": "john@example.com"
    },
    "token": "1dd166e7-4193-4e9f-8ded-b72c37046814|LyRukLVhPBgt4o8O8gla6xQn75LuoKLRurLY3M8rc6d78c0c"
}
```

---

### Tasks

| Method | Endpoint                | Description                  |
|--------|-------------------------|------------------------------|
| POST   | /api/tasks              | Create a new task            |
| GET    | /api/tasks              | List all tasks               |
| PUT    | /api/tasks/{id}/status | Update task status           |
| DELETE | /api/tasks/{id}        | Delete a task                |
| GET    | /api/tasks/status/{s}  | Filter tasks by status       |

**All task endpoints require authentication.**

---

## Testing in Postman

### 1. Register User

- **POST** `/api/register`
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### 2. Login User

- **POST** `/api/login`
```json
{
  "email": "jane@example.com",
  "password": "password"
}
```

Save the returned `token`.

---

### 3. Create Task

- **POST** `/api/tasks`
- **Headers**:
  - `Authorization: Bearer YOUR_TOKEN`
  - `Content-Type: application/json`
  - `Accept: application/json`
```json
{
  "title": "Finish report",
  "description": "Write and submit the Q2 financial report"
}
```

---

### 4. List All Tasks

- **GET** `/api/tasks`
- **Headers**:
  - `Authorization: Bearer YOUR_TOKEN`
  - `Content-Type: application/json`
  - `Accept: application/json`

---

### 5. Update Task Status

- **PUT** `/api/tasks/{id}/status`
- Replace `{id}` with the task ID
- **Headers**:
  - `Authorization: Bearer YOUR_TOKEN`
  - `Content-Type: application/json`
  - `Accept: application/json`
```json
{
  "status": "completed"
}
```

Allowed statuses: `pending`, `in_progress`, `completed`, `cancelled`

---

### 6. Delete Task

- **DELETE** `/api/tasks/{id}`
- Replace `{id}` with the task ID
- **Headers**:
  - `Authorization: Bearer YOUR_TOKEN`
  - `Content-Type: application/json`
  - `Accept: application/json`

---

### 7. Filter Tasks by Status

- **GET** `/api/tasks/status/{status}`
- Replace `{status}` with one of the allowed values
- **Headers**:
  - `Authorization: Bearer YOUR_TOKEN`
  - `Content-Type: application/json`
  - `Accept: application/json`

---

## Run Tests

To run unit and integration tests using SQLite in memory:

```bash
php artisan test
```

---

## API Documentation with Swagger

To generate the Swagger documentation:

```bash
php artisan l5-swagger:generate
```

Access the documentation at:

```
http://localhost:8000/api/docs
```

---

## Project Highlights

- Clean architecture(constrollers, services, repositories, interfaces/contracts, requests, DTOs, Exceptions, etc.)
- Service layer abstraction for business logic
- Laravel validation and error handling
- Meaningful HTTP status codes
- Fully tested
- Simple and maintainable codebase

---

## Author

**Jonas C. Portugal**  
jonascportugal30@gmail.com
