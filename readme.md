# Installation
Clone the project and run ```composer install```.
To create the database, access project directory from the console and run ```php vendor/bin/phinx migrate```.
To seed the database with dummy data use ```php vendor/bin/phinx seed:run```. Running the seeders will create 50 users in the database.

# Run the project
Access /backend/accounts/<some integer between 1-50>