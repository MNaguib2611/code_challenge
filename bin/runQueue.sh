#!/bin/bash


# 9-run a command to dipatch the job to the queue
docker exec -it backend bash -c "php artisan seed:movies"
