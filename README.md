docker-compose up -d 

docker-compose exec app composer install

docker-compose exec app php artisan key:generate

Nvigate to ``http://localhost/form``

## NOTE!!
in ``.env`` ``MAIL_MAILER=log`` so mail is just store to log

if needed real transport ``MAIL_MAILER=`` should be configured to real transport smtp, mailgun etc....see ``config/mail.php``

## NOTE!!
keys are stored in .env to simplify check. In real app it should be hidden, and will be removed in few days after check
