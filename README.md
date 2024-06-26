

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
10. **Удалите текущую символическую ссылку (если она существует):**

   ```bash
   rm -rf public/storage
   ```
11. **Создайте новую символическую ссылку:**

    ```bash
    php artisan storage:link
    ```
## Database Seeding

### Running the Seeder

To seed the database with the `BlogsTableSeeder`, use the following command:

```sh
php artisan db:seed --class=BlogsTableSeeder



## Project Screenshots

### Screenshot 1: Home Page
![Home Page](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/homepage.png)
The home page provides an overview of the application and its features.

### Screenshot 2: Profile Page
![Profile Page](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/profile-page.png)
The profile page displays user information and their activity within the app.

### Screenshot 3: Blog
![Blog](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/blog.png)
The blog section where users can read and post articles.

### Screenshot 4: Create Test Quiz
![Create Test Quiz](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/tests.png)
This page allows users to create a new test quiz with various questions.

### Screenshot 5: Test Quiz for User
![Test Quiz for User](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/test.png)
Users can take quizzes and test their knowledge on different topics.

### Screenshot 6: Lectures
![Lectures](https://github.com/DevDuulat/laravel-quiz-app/blob/main/screenshots/lectures.png)
The lectures section where users can access educational materials and resources.


