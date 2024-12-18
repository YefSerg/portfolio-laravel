##################
# Variables
##################

DOCKER_COMPOSE = docker compose -f ./docker/docker-compose.yml

##################
# Docker compose
##################

dc_build:
	${DOCKER_COMPOSE} build

dc_start:
	${DOCKER_COMPOSE} start
start: dc_start

dc_stop:
	${DOCKER_COMPOSE} stop
stop: dc_stop

dc_up:
	${DOCKER_COMPOSE} up -d --remove-orphans

dc_ps:
	${DOCKER_COMPOSE} ps

dc_logs:
	${DOCKER_COMPOSE} logs -f

dc_down:
	${DOCKER_COMPOSE} down --remove-orphans

dc_down_with_volumes:
	${DOCKER_COMPOSE} down -v --remove-orphans

dc_down_with_images:
	${DOCKER_COMPOSE} down --rmi=all --remove-orphans

dc_down_all:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

dc_restart:
	make dc_stop dc_start


##################
# App
##################

app_bash:
	${DOCKER_COMPOSE} exec -u www-data app bash
php: app_bash

test:
	${DOCKER_COMPOSE} exec -u www-data php artisan test


