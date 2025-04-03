<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Loan Track

Loan Track is a loan management system built with Laravel Jetstream and Vue.js. It allows users to add and manage people, track their loan and return records, and perform filtering, searching, and sorting functionalities.

## Features

- **User Management:** Users can add people along with their personal information.
- **Loan Tracking:** Track loans and returns for each person.
- **Filtering & Sorting:** Search, filter, and sort people based on name, township, current amount, etc.
- **Access Control:**
    - Users can manage only the people they added.
    - Admins have full access to manage all entries.
- **Secure Authentication:** Leveraging Laravel Jetstream for authentication and authorization.
- **Modern UI:** A seamless and interactive interface powered by Vue.js.

## Tech Stack

- **Backend:** Laravel Jetstream (Laravel, Inertia.js, API-driven architecture)
- **Frontend:** Vue.js
- **Database:** MySQL (or any supported relational database)
- **Authentication:** Laravel Jetstream with role-based access control

## Installation

### Prerequisites
- PHP (>=8.0)
- Composer
- Node.js & npm
- MySQL (or another relational database)

### Setup
1. Clone the repository:
   ```sh
   git clone https://github.com/thevowels/LoanRecords.git
   cd LoanRecords
   ```
2. Install dependencies:
   ```sh
   composer install
   npm install && npm run dev
   ```
3. Set up environment variables:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure the database in the `.env` file and run migrations:
   ```sh
   php artisan migrate --seed
   ```
5. Start the development server:
   ```sh
   php artisan serve
   ```

## Usage
- Register/Login as a user.
- Add people and track their loans/returns.
- Filter, search, and sort based on available options.
- Admins can manage all data.
