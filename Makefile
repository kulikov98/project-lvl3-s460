install:
	composer install
test:
	composer run-script phpunit tests
lint:
	composer run-script phpcs -- --standard=PSR12 app/Http
	composer run-script phpcs -- --standard=PSR12 tests
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/lumen.log
db:
	php artisan migrate:refresh --seed --force