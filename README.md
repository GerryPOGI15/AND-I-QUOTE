## Installation

1. Clone the repository
Master Branch

   git clone https://github.com/GerryPOGI15/AND-I-QUOTE.git

   cd yourproject

3. Install PHP dependencies

   composer install

5. Install Node.js dependencies

   npm install
7. Copy environment file

   cp .env.example .env
   
9. Generate application key

   php artisan key:generate

11. Configure your database credentials and other environment variables in .env

    php artisan migrate

13. Build frontend assets

    npm run dev

Running the Application Locally

    php artisan serve

http://127.0.0.1:8000 - run in browser
