############ Manual to run this task project ###########

After Clone from GitHUb

***changes in files***
1) configure database setup in .env file and phpmyadmin.
2) Add mailtrap key in .env files.
3) Add Stripe secret key in .env file.

***Commands need to run on terminal***

step 1: composer i
step 2: composer require stripe/stripe-php
step 3: php artisan serve
step 4: npm i
step 5: npm run dev 
step 6: php artisan migrate:fresh --seed


Note: Forget password Changing link will be recieved only in mailtrap.