PATH_WINE=~/core-dev/wine
WINE_SERVER_NAME=php83_server_wine
WEB_SERVER_NAME=web_server_wine
MYSQL_SERVER_NAME=mysql_server_wine
WINE_PATH=/var/www/html/wine/


DOCKER_NETWORK_IP := $(shell docker network inspect bridge -f '{{range .IPAM.Config}}{{.Gateway}}{{end}}' 2>/dev/null)
export CURRENT_UID := $(shell id -u):$(shell id -g)

define execute_command
	@docker container exec -it -w ${2} ${1}  ${3}
endef

define check_host
	@if grep -Fx '$(DOCKER_NETWORK_IP) ${1}' /etc/hosts; then echo 'Ya existe ${1} en /etc/hosts'; else echo '$(DOCKER_NETWORK_IP) ${1}' | sudo tee -a /etc/hosts;	fi
endef

# DOCKER


run:
	docker compose start

stop:
	docker compose stop

status:
	docker compose ps

destroy:
	docker compose down --volumes --rmi local
	docker builder prune -f

install: hosts
	$(MAKE) env
	$(MAKE) destroy
	docker compose up -d
	$(MAKE) composer-install-wine
logs:
	docker compose logs -f

ssh-php:
	docker container exec -it $(WINE_SERVER_NAME) sh

ssh-nginx:
	docker container exec -it $(WEB_SERVER_NAME) sh

ssh-mysql:
	docker container exec -it $(MYSQL_SERVER_NAME) sh

hosts:
	$(call check_host,wine.test)

composer-install-wine:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), composer install)

composer-update-wine:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), composer update)

composer-cc-wine:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), composer clear-cache)

# FICHEROS DE CONFIGURACIÓN LOCAL
env:
	@cp ./.docker-local/resources/wine.env.local $(PATH_WINE)/.env.local

# MIGRACIONES
migration-generate:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console doctrine:migrations:generate)

migration-apply:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console --no-interaction doctrine:migrations:migrate)

migration-ini:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console --no-interaction doctrine:migrations:migrate first)

migration-status:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console doctrine:migrations:status)

migration-apply-test:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console --no-interaction doctrine:migrations:migrate --env=test)

migration-ini-test:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console --no-interaction doctrine:migrations:migrate first --env=test)

migration-status-test:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), php bin/console doctrine:migrations:status --env=test)

unit-tests:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), vendor/bin/phpunit --testsuite Unit)

integration-tests:
	$(call execute_command, $(WINE_SERVER_NAME), $(WINE_PATH), vendor/bin/phpunit --testsuite Integration)
