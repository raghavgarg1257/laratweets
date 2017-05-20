# Laratweets
A simple clone of twitter built using Laravel 5.4.


## steps to run

git clone git@github.com:raghavgarg1257/laratweets.git

cd laratweets

composer install

npm install

nano .env # edit database credentials, add DB name and also create it on your machine

php artisan migrate:refresh

php artisan serve # app will be started on localhost:8000


Note - since the app is just starting up, there will be no data(user or tweets), you have to register and seed the data yourself for testing.
