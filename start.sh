#!/bin/bash

if [ -f "backend/.env" ]; then
    echo "A .env fájl már létezik"
else
    cp backend/.env.example backend/.env
fi

ln -s backend/.env

docker compose up -d

docker compose exec backend composer install

docker compose exec backend php artisan migrate

if [ -z "${APP_KEY}" ]; then
    docker compose exec backend php artisan key:generate
else
    echo "Az API kulcs már létezik" 
fi