setup_application:
	@echo "making .env"
	cp src/.env.example src/.env
	@echo "\n\nsetting up docker"
	docker-compose build && docker-compose up -d
	@echo "\n\nRunning Composer in Docker"
	docker exec -it app composer install

