#!/bin/bash

# 1-copy .env.example to .env
cp .env.example .env


# 1- kill containers if it was running
docker-compose down


# 2- create docker network
docker network create themoviedb

# 3-build docker containers
docker-compose build


# 3-run docker containers
docker-compose up -d


# 4-change storage to the correct permissions
chmod 777 -R storage/
