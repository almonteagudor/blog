APACHE_CONTAINER = blog-apache

start:
	docker-compose up -d

stop:
	docker-compose stop

restart:
	$(MAKE) stop && $(MAKE) start

build:
	docker-compose up --build -d

prepare:
	$(MAKE) composer-install

composer-install:
	docker exec -it ${APACHE_CONTAINER} composer install --no-scripts --no-interaction --optimize-autoloader

ssh-apache:
	docker exec -it ${APACHE_CONTAINER} bash

tests:
	docker exec -it ${APACHE_CONTAINER} php artisan test
