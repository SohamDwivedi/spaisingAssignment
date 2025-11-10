# 🛒 Full-Stack Technical Test — Backend (Laravel 11 + MySQL + JWT)

## 📘 Overview
This repository contains the **backend** implementation of the Full-Stack Technical Test built with **Laravel 11 (PHP 8.3)** and **MySQL**.  
It provides a fully functional REST API supporting:

- JWT-based authentication (Register/Login/Logout/Me)
- Role-based authorization (`user` and `admin`)
- Product management (CRUD)
- Cart management
- Order checkout with stock validation and transactional safety
- Order confirmation email via Mailtrap
- Global structured JSON exception handling
- PHPUnit test coverage for order module (success + failure)

---

## ⚙️ Tech Stack

| Component | Version | Description |
|------------|----------|-------------|
| Laravel | 11.x | PHP Web Framework |
| PHP | 8.3 | Core runtime |
| MySQL | 8+ | Relational Database |
| JWTAuth | php-open-source-saver/jwt-auth | JWT Authentication |
| Mailtrap | Sandbox SMTP | Test email delivery |
| PHPUnit | 11.x | Testing Framework |  

---

## 🚀 Installation & Setup

### Clone the repository
```bash
git clone https://github.com/SohamDwivedi/spaisingAssignment.git
cd backend

Install dependencies
composer install

Copy environment file
cp .env.example .env

Then update environment variables:
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spaising
DB_USERNAME=root
DB_PASSWORD=

# JWT Auth
JWT_SECRET=your_generated_secret

# Mailtrap (sandbox)
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=f98e10da9f8a14
MAIL_PASSWORD=<your-mailtrap-password>
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

Generate keys:

php artisan key:generate
php artisan jwt:secret

Run migrations & seeders

php artisan migrate:fresh --seed

This seeds:

1 Admin user

4 Regular users

10 Sample products

Start development server

php artisan serve


Server will run on:
👉 http://127.0.0.1:8000

🔐 Authentication Endpoints
Method	Endpoint	Description
POST	/api/auth/register	Register a new user
POST	/api/auth/login	Login & get JWT token
POST	/api/auth/logout	Logout user
GET	/api/auth/me	Get user details (requires token)

🔐 Auth APIs

Method	Endpoint	Description
POST	/api/auth/register	Register a new user
POST	/api/auth/login	Log in a user and issue token
POST	/api/auth/logout	Log out the authenticated user
GET	/api/auth/me	Get details of the currently authenticated user

🛒 Cart & Orders (User APIs)

Method	Endpoint	Description
GET	/api/cart	Get all cart items for the logged-in user
POST	/api/cart	Add product to cart
PATCH	/api/cart/items/{productId}	Update quantity of a product in the cart
DELETE	/api/cart/items/{productId}	Remove or reduce a product from the cart
POST	/api/checkout	Checkout and create order, update stock
GET	/api/orders	Get all orders of the user
GET	/api/orders/{id}	Get details of a single order

🛍️ Public Product APIs

Method	Endpoint	Description
GET	/api/public/products	Get paginated list of all products
GET	/api/public/products/{id}	Get details of a single product

🧑‍💼 Admin Dashboard & Management APIs

Method	Endpoint	Description
GET	/api/admin/dashboard	Get overall dashboard metrics (users, products, revenue)
GET	/api/admin/orders	List all orders in the system
GET	/api/admin/orders/{id}	View details of a specific order
GET	/api/admin/products	List all products (admin view)
POST	/api/admin/products	Add a new product
PUT	/api/admin/products/{id}	Update an existing product
PATCH	/api/admin/products/{id}	Update an existing product (partial)
DELETE	/api/admin/products/{id}	Delete a product
GET	/api/admin/users	List all registered users

⚙️ Utility & Fallback Routes

Method	Endpoint	Description
GET	/api/{fallbackPlaceholder}	Fallback for undefined API routes
GET	/storage/{path}	Serve uploaded storage files
GET	/up	Laravel health check endpoint




Checkout Flow

Validates stock quantity

Creates Order and OrderItem records

Decrements stock

Clears cart

Sends confirmation email (via Mailtrap)

ADMIN API's

| Method   | Endpoint                   | Description                           |
| -------- | -------------------------- | ------------------------------------- |
| `GET`    | `/api/admin/dashboard`     | Get totals (users, products, revenue) |
| `GET`    | `/api/admin/products`      | Get all products                      |
| `POST`   | `/api/admin/products`      | Create new product                    |
| `PATCH`  | `/api/admin/products/{id}` | Update product                        |
| `DELETE` | `/api/admin/products/{id}` | Delete product                        |
| `GET`    | `/api/admin/orders`        | View all orders                       |
| `GET`    | `/api/admin/orders/{id}`   | Get single order details              |
| `GET`    | `/api/admin/users`         | List all users                        |


All exceptions are globally handled inside bootstrap/app.php
Each error returns a structured JSON response:

Example:

{
  "status": "error",
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."]
  }
}


📬 Mailtrap Integration (SMTP Sandbox)

Order confirmation emails are sent using Mailtrap.

Configure inside .env:

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=f98e10da9f8a14
MAIL_PASSWORD=<your-mailtrap-password>
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="Laravel E-Commerce"


🧪 Testing

Run all tests using:

php artisan test


✅ Covered Tests:

Successful checkout (happy path)

Failed checkout (stock insufficient)

Expected Output:

PASS  Tests\Feature\OrderTest
✓ user can checkout successfully
✓ checkout fails when stock is insufficient



🧑‍💻 Developer Info

Author: Soham
Role: Software Engineer
Experience: 4.5+ years
Expertise: Laravel, React, Angular, Node.js, AWS, MySQL, MongoDB, GraphQL, S3, EC2, Lambda, DynamoDB, RDS, SQS


📄 License

This project was created for a technical assessment and can be used for learning or evaluation purposes.