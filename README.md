## About Project

The Sample Chat application made using Web Sockets and Laravel. 

 
### Installation

1. Clone the repo
2. Install composer packages
   ```PHP
   composer install
   ```

3. Install NPM packages
   ```JS
   npm install
   ```
   ```JS
    npm install --global nodemon
   ```
 
   
4. Rename .env.example to .env & add Database name in .env file
    ```PHP
    DB_DATABASE = 'YOUR DATABASE NAME'
    ```
   
5. Migrate Database and Seed dummy data
   ```PHP
     php artisan migrate --seed
   ```

   
6. Open two terminal or command promopt and run both commands in seperate tabs
  
  
   ```PHP
   php artisan serve;
   ```

   ```JS
   nodemon server;
   ```

7. Login with any user in two seperate browsers. 

  ```Sh
   mobile no. = choose any mobile no from database;
   password   = password;
   ```