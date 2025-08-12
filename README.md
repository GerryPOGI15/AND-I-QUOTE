## Installation

1. Clone the repository
Master Branch

   git clone https://github.com/GerryPOGI15/AND-I-QUOTE.git

   cd yourproject

3. Install PHP dependencies
composer install

4. Install Node.js dependencies
    npm install
5. Copy environment file
   cp .env.example .env
6. Generate application key
   php artisan key:generate
7. Configure your database credentials and other environment variables in .env
    php artisan migrate
8. Build frontend assets
   npm run dev
Running the Application Locally
    php artisan serve

