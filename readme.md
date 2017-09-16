# Installation
Clone the project and run ```composer install```.
Since project has database, it has robmorgan/phinx package installed. Before to run migrations, create your database in 
the database server, then run ```php vendoe/bin/phinx init``` from the project directory. This command will produce file 
named phinx.yml. That is where you should put your database config for phinx. To create the tables, access project 
directory from the console and run ```php vendor/bin/phinx migrate```.
To seed the database with dummy data use ```php vendor/bin/phinx seed:run```. Running the seeders will create 50 users 
in the database.

Configuring the database connection is another necessary step. Inside backend/conf/ directory there is file config.dist.yml.
Copy that file and rename it config.yml. After each config parameter, put your database connection attributes.

Now the project should be fully functional.

# Run the project
Access /backend/accounts/<some integer between 1-50>