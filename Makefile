lint:
	phpcs && phpcbf && ./vendor/bin/phplint ./ && ./vendor/bin/phpstan analyse --memory-limit=2G

test:
	php artisan test