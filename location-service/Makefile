.PHONY: ssh composer-install up build

ssh:
	@docker-compose exec php sh

composer-install:
	@sh composer install

up:
	@docker-compose up --build -d ;\
	docker-compose logs -f || exit 0 ;\

build: composer-install up
