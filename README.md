![image](https://github.com/user-attachments/assets/fb3ca6a6-25ad-4575-8600-88f4caa37580)

# Laravel Browser Paste App

A Laravel application that allows users to store text and generate a unique URL for easy access. The app provides options for setting time limits, view limits, and password protection for enhanced security.

## Features

- **Text Storage with Unique URL**: Enter text and generate a random URL to access it.
- **Time Limit**: Set a time limit for how long the URL will be active.
- **View Limit**: Restrict the number of times the URL can be accessed.
- **Password Protection**: Optionally set a password to protect access to the text.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/fevziatanoglu/laravel-browser-paste-app.git
    ```

2. Navigate to the project directory:
    ```bash
    cd laravel-browser-paste-app
    ```

3. Install dependencies:
    ```bash
    composer install
    npm install
    ```

4. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

5. Generate an application key:
    ```bash
    php artisan key:generate
    ```

6. Set up your database in the `.env` file and run migrations:
    ```bash
    php artisan migrate
    ```

7. Compile assets:
    ```bash
    npm run dev
    ```

8. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

1. Visit the application in your browser.
2. Enter the text you want to store.
3. Optionally set a time limit, view limit, and password.
4. Generate the URL and share it as needed.
5. The text can be accessed via the generated URL according to the limits and conditions you set.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any feature requests or bugs.

