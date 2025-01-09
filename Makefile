# Build Docker
build:
	docker-compose build

# Spin up containers
up:
	docker-compose up -d

# Stop and remove containers
down:
	docker-compose down

# Open a shell to the Nginx container
shell:
	docker exec --workdir /var/www/html/nyt-api -it nginx /bin/sh

# Run Composer
composer:
	docker exec --workdir /var/www/html/nyt-api -it nginx composer $(args)

# Run Artisan commands
artisan:
	docker exec --workdir /var/www/html/nyt-api -it nginx php artisan $(args)

# Run Tests
test:
	docker exec --workdir /var/www/html/nyt-api -it nginx php artisan test