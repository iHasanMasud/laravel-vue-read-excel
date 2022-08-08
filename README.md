# Getting started

## Features

- Show all data in report page(with server side pagination)
- Cells will be red if IN time is bigger than an input field time and Yellow if  Out Time is Lower than another input field
- Can search by ID in report page
- Generate a pdf on the report
- Support Bangla Font

## Installation


Clone the repository

    git clone https://github.com/iHasanMasud/laravel-vue-read-excel.git

Switch to the repo folder

    cd laravel-vue-read-excel

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Install application dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate

Link Storage/app/public to public folder

    php artisan storage:link

Run the database migrations

    php artisan migrate

Run the database seeder

    php artisan db:seed


Install frontend dependencies using npm

    npm install

Watch for changes in the frontend code and run the build process

    npm run watch

Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000

