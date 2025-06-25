# Laravel Product API

This is a Laravel 10-based RESTful API project for managing products and categories. It uses PostgreSQL as the database and follows best practices such as service layer separation, API Resource formatting, and request validation via FormRequests. The project is containerized with Docker to simplify setup and ensure consistent environments.

## Features

- Manage categories and products with full CRUD operations.
- Fetch products by category.
- Clean architecture with Service classes handling business logic.
- API Resources for consistent JSON responses.
- PostgreSQL as a relational database.
- Dockerized environment for easy deployment.

## Requirements

- Docker & Docker Compose
- PHP 8.1+
- Composer

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/humblebek/productapi.git
   cd productapi
Copy .env.example to .env and update your environment variables, especially PostgreSQL credentials:

cp .env.example .env

Build and start Docker containers:
docker-compose up -d --build

Enter the app container:
docker exec -it product_app bash

Install PHP dependencies and run migrations:
composer install
php artisan key:generate
php artisan migrate


Example endpoints:

GET /products — list all products

POST /products — create a new product

GET /categories — list all categories

GET /categories/{id}/products — get products by categ
