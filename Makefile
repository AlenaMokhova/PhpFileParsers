exec_user = docker compose exec app

build:
	docker compose up -d
	${exec_user} composer install

up:
	docker compose up -d

down:
	docker compose down

sh:
	${exec_user} sh

rebuild:
	docker compose up -d --build

psalm:
	${exec_user} vendor/bin/psalm

php-lint:
	${exec_user} vendor/bin/phplint