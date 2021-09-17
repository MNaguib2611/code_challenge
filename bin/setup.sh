#!/bin/bash


# 1-copy .env.example to .env
cp .env.example .env

# 2-change storage to the correct permissions
chmod 777 -R storage/

# 3- kill containers if it was running
docker-compose down


# 4- create docker network
docker network create themoviedb

# 5-build docker containers
# docker-compose build


# 6-run docker containers
docker-compose up -d


# 7-we might need to change the permissions from wihin the container
docker exec -it backend bash -c "chmod 777 -R storage"

# 8-run-migration to create the table && run seeder to create genres
docker exec -it backend bash -c "php artisan migrate:fresh && php artisan db:seed"



# 9-run a command to dipatch the job to the queue
docker exec -it backend bash -c "php artisan seed:movies"
