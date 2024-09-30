# USDA Farm Market Pricing Tool

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- [PHP](https://www.php.net/manual/en/install.php) (version 7.3 or higher)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/) (version 12 or higher)
- [Laravel](https://laravel.com/docs/8.x/installation)
- [MySQL](https://dev.mysql.com/downloads/mysql/)

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/your-username/usda-farm-market-pricing-tool.git
    cd usda-farm-market-pricing-tool
    ```

2. **Install PHP dependencies:**

    ```sh
    composer install
    ```

3. **Install Node.js dependencies:**

    ```sh
    npm install
    ```

## Setting Up the Environment

1. **Copy the `.env.example` file to `.env`:**

    ```sh
    cp .env.example .env
    ```

2. **Generate the application key:**

    ```sh
    php artisan key:generate
    ```

3. **Configure your `.env` file:**
    - Set your database credentials:

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_user
        DB_PASSWORD=your_database_password
        ```

## Database Setup

1. **Start MySQL server:**
    - On Windows:

        ```sh
        net start MySQL
        ```

    - On macOS:

        ```sh
        brew services start mysql
        ```

    - On Linux:

        ```sh
        sudo service mysql start
        ```

2. **Create the database:**

    ```sql
    CREATE DATABASE your_database_name;
    ```

3. **Run database migrations:**

    ```sh
    php artisan migrate
    ```

## Running the Application

1. **Start the development server:**

    ```sh
    php artisan serve
    ```

2. **Compile the assets:**

    ```sh
    npm run dev
    ```

Your application should now be running at [http://localhost:8000](http://localhost:8000).

## License

The USDA Farm Market Pricing Tool is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
