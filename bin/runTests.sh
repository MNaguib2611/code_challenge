#!/bin/bash


# 1-run test cases from inside container
docker exec -it backend bash -c "./vendor/bin/phpunit"
