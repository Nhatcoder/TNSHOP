# TNSHOP

## Introduction

TNSHOP is a web application for managing online shops, allowing users to manage products, track orders, and handle various administrative tasks. This project is developed using main languages and technologies such as JavaScript, CSS, Blade, PHP, Laravel, Bootstrap 5, HTML, JQuery, Ajax, and SQL.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Directory Structure](#directory-structure)
- [Contribution](#contribution)
- [License](#license)

## Features

- Technologies used: PHP, Laravel, Bootstrap 5, HTML/CSS, JQuery, JavaScript, Ajax, SQL
- CRUD operations for Categories, Subcategories, Products, Brands, Product Models, Discount Codes
- Revenue statistics and reviews
- Order tracking
- Google Login, Login, Registration, Password Recovery, Role Management
- Product model details
- Order PDF export
- Advanced search filtering, pagination, reviews
- Favorite products
- Integration with Momo and VNPay for order payments
- Queue mail sending
- User profile page

## Installation

### Requirements

- Node.js and npm
- Composer
- A web server like Apache or Nginx

### Installation Guide

1. Clone the repository to your machine:

    ```sh
    git clone https://github.com/Nhatcoder/TNSHOP.git
    ```

2. Install backend dependencies:

    ```sh
    composer install
    ```

3. Install frontend dependencies:

    ```sh
    npm install
    ```

4. Create the `.env` file from the example file `.env.example` and update the necessary configuration information:

    ```sh
    cp .env.example .env
    ```

5. Run migrations and seed data:

    ```sh
    php artisan migrate --seed
    ```

6. Start the server:

    ```sh
    php artisan serve
    npm run dev
    php artisan queue:work --sleep=0
    ```

## Usage

After successful installation, you can access the web application at `http://localhost:8000`.

- Register/Login account
- Manage products and categories
- Track orders
- Manage user roles and permissions
- View revenue statistics and product reviews
- Export orders to PDF
- Use advanced search filtering and pagination
- Integrate with payment gateways Momo and VNPay
- Manage favorite products
- Send emails via queue
- Edit personal profile

## Directory Structure

```plaintext
TNSHOP/
├── app/                # Directory containing backend PHP files
├── public/             # Directory containing static files like images, CSS, JavaScript
├── resources/          # Directory containing Blade templates and frontend source files
├── routes/             # Directory containing route definition files
├── storage/            # Directory containing cache and logs files
├── tests/              # Directory containing test files
├── .env.example        # Example environment configuration file
├── composer.json       # Composer configuration file
├── package.json        # npm configuration file
└── README.md           # This file
