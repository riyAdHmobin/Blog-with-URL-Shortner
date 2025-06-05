# Makefile

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f

bash:
	docker exec -it blog_with_url_shortner-apache-php bash

db-bash:
	docker exec -it blog_with_url_shortner-mysql bash

composer-install:
	docker exec -it blog_with_url_shortner-apache-php composer install

artisan:
	docker exec -it blog_with_url_shortner-apache-php php artisan

migrate:
	docker exec -it blog_with_url_shortner-apache-php php artisan migrate

.PHONY: up down build logs bash db-bash composer-install artisan migrate