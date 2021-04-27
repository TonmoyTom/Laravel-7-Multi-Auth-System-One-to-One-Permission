Laravel 7 Application with Multiple Authentication

Laravel 7 application with admin guard. You can even use this application for your projects if you need multiple guards. Getting this app up and running

  *Make sure you already have xampp installed (easy to use).

 *Clone this repository to your local machine or just download the zip from the above green button.

 *Install Composer first, then run this command in your command-line (you should be inside your project directory).

            composer install

Rename .env.example to .env and add your database.

Generate application key.

            php artisan key:generate

Create tables.

            php artisan migrate

Start the development server.

            php artisan serve

What it does?

laravel application with admin guard. You can even use this application for your projects if you need multiple guards.

        User    
            {guard:user}/Profile
            {guard:user}/Profile/Edit With Ajax
            {guard:user}/Profile/Change Password With Ajax
            
        Admin
            {guard:Admin}/login
            {guard:Admin}/register
            {guard:Admin}/logout
            {guard:Admin}/password/reset
            {guard:Admin}/password/email
            {guard:Admin}/home
            {guard:Admin}/Profile
            {guard:Admin}/Profile/Edit With Ajax
            {guard:Admin}/Profile/Change Password With Ajax

Usage

Flash Messages: use status key for success messages and error key for error messages.

Guards: web (default) and admin (custom).

Auth middleware for admin guard: auth:admin for authenticated users using admin guard.

Guest middleware for admin guard: guest:admin for unauthenticated users using admin guard.

This application has a custom middleware EnsureCustomGuardIsVerified that can be used for verifying emails of custom guards. This middleware is registered in the application as guard.verified and takes two arguments first guard name and second route name that will be used for redirecting unverified users. Example: guard.verified:admin,admin.verification.notice or guard.verified:customer,customers.verify-notice.

Don't use @auth or @guest directives for default guard, use Auth::guard('web')->check() with @if instead.

Admin and Default routes are seperated and all the admin routes are prefixed by admin.
