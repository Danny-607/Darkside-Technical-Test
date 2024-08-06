# Installation steps:

1. Clone the repository
2. Run the following commands:
- npm install
- composer install
- cp .env.example .env
- ensure that the following values are set in the .env file:
    - DB_CONNECTION=mysql
    - DB_HOST=mysql
    - DB_PORT=3306
    - DB_DATABASE=laravel
    - DB_USERNAME=sail
    - DB_PASSWORD=password
- php artisan key:generate
- OPTIONAL: alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)' (for easier sail usage, you can replace the "./vendor/bin/sail" with "sail" in the following commands)
- ./vendor/bin/sail up -d
- ./vendor/bin/sail artisan migrate:fresh
- ./vendor/bin/sail artisan db:seed
- ./vendor/bin/sail npm run dev

## Running the tests
To run the tests, you can run the following command:
- ./vendor/bin/sail test

# Usage
When using the application, there is already a test user set up with the following credentials:
- email: test@example.com
- password: password

User needs to be logged in to access the customer part of the application. When logged in just press the Customer Dashboard button on the navigation bar, this will take you to the customer dashboard where you can access the CRUD functionality for the customers.


