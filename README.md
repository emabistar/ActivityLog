
# Coding Challenge
In order to run this  peoject you need to  follow the steps bellow

# Running the project locally
# Create your own database with credential
*DB_CONNECTION=mysql

*DB_HOST=''

*DB_PORT=''

*DB_DATABASE=''


*DB_USERNAME=''

*DB_PASSWORD=

# Install the necessary dependencies
* run 
* composer install
* npm install
#Create .env file

* On window
* cp .env.example  .env

* On Mac 

* copy .env.example  .env

* fill you db credential in the .env file you created earlier

# seed de database with  userseed
* php artisan migrate
