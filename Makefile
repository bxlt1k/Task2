include .env

migrations:
	@docker run --network host task2_migrate -path=/migrations/ -database "mysql://root:root@tcp(task2.loc:8989)/test" up

docker-start:
	@docker-compose up -d

docker-stop:
	@docker-compose down

docker-restart:
	@docker-compose down
	@docker-compose up -d