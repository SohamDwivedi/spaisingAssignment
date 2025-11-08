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

### 1️⃣ Clone the repository
```bash
git clone https://github.com/<your-username>/<your-repo>.git
cd backend
