

## CryptoFort

## Prerequisites

List any prerequisites that are needed to run your project, such as:
- PHP (8.1 and above)
- Composer
- Node.js & npm
- MySQL

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/DevDuulat/laravel-quiz-app.git
   cd laravel-quiz-app
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**

   ```bash
   npm install
   ```

4. **Copy environment file:**

   ```bash
   cp .env.example .env
   ```

5. **Set up your database:**

    - Open `.env` file and set your database connection details:
      ```
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=your_database_name
      DB_USERNAME=your_database_user
      DB_PASSWORD=your_database_password
      ```

6. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

7. **Seed the database:**

   ```bash
   php artisan db:seed
   ```

8. **Generate application key:**

   ```bash
   php artisan key:generate
   ``` 

9. **Build Frontend Assets**

    ```bash
   npm run build
   ```
10.**Delete the current symbolic link (if it exists):**

   ```bash
   rm -rf public/storage
   ```
11. **Create a new symbolic link:**

    ```bash
    php artisan storage:link
    ```
## Database Seeding

### Running the Seeder

To seed the database with the `BlogsTableSeeder`, use the following command:

```sh
php artisan db:seed --class=BlogsTableSeeder
```


## Project Screenshots

Project Screenshots
Screenshot 1: Home Page

<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/homepage.png"/>

Screenshot 2: Profile Page
 
<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/profile-page.png"/>
 
Screenshot 3: Blog

<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/blog.png"/>

Screenshot 4: Create Test Quiz

<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/tests.png"/>

Screenshot 5: Test Quiz for User

<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/test.png"/>

Screenshot 6: Lectures

<img src="https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/lectures.png"/>

