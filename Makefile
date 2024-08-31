setup:
	@make build
	@make up 
	@make composer-update
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec sistema-gestion-tareas bash -c "composer update"
data:
	docker exec sistema-gestion-tareas bash -c "php artisan migrate"
	docker exec sistema-gestion-tareas bash -c "php artisan db:seed"