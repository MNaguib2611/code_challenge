#!/bin/bash





# 1-copy .env.example to .env
cp .env.example .env

# 4-change storage to the correct permissions
chmod 777 -R storage/

# 1- kill containers if it was running
docker-compose down


# 2- create docker network
docker network create themoviedb

# 3-build docker containers
docker-compose build


# 3-run docker containers
docker-compose up -d


# 3-run migrations & seeders through docker container
docker exec -it backend bash -c "php artisan migrate && php artisan:seed"

