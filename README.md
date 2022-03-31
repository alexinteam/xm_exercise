## Start
docker-compose up -d 

docker-compose exec app composer install

docker-compose exec app php artisan key:generate

Navigate to ``http://localhost/form``


### running tests
docker-compose exec app php artisan test

### running test coverage

docker-compose exec app php artisan test --coverage-html tests/reports/coverage

view in ``tests/reports/coverage/index.html``

## NOTE!!
* in ``.env`` ``MAIL_MAILER=log`` so mail is just store to log ``storage/logs/laravel.log``

* if needed real transport ``MAIL_MAILER=`` should be configured to real transport smtp if needed, mailgun etc....see ``config/mail.php``

* keys are stored in .env to simplify check. In real app it should be hidden, and **will be removed in few days after check**

* **DID NOT** cover Laravel Build-in classes
