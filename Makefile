lint:
	phpcbf && phpcs && ./vendor/bin/phplint ./ --no-cache  && ./vendor/bin/phpstan analyse --memory-limit=2G

test:
	php artisan test --parallel
