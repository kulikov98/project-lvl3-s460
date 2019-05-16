install:
	composer install
test:
	composer run-script phpunit tests
lint:
	composer run-script phpcs -- --standard=PSR2 app/Http
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/lumen.log
db:
	php artisan migrate:refresh --seed --force