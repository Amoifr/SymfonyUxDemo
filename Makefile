CONTAINER_NAME := $(shell docker ps --format '{{.Names}}' --filter "ancestor=dunglas/frankenphp" | head -n 1)
CUSTOM_CONTAINER_NAME := $(shell docker ps --format '{{.Names}}' --filter "ancestor=custom-franken-php" | head -n 1)

PWD := $(shell pwd)

.PHONY: help

up:
	echo "Starting container ${PWD}"
	docker run --rm -ti -v ${PWD}:/app -p 443:443 custom-franken-php
down:
	docker stop ${CUSTOM_CONTAINER_NAME}

composer:
	docker run --rm -it -v .:/app composer:latest install


asset-map:
	docker exec -ti ${CUSTOM_CONTAINER_NAME}  php bin/console asset-map:compile

build:
	docker build -t custom-franken-php .

bash:
	docker exec -ti ${CUSTOM_CONTAINER_NAME} bash