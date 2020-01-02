COMPOSE := docker-compose -f .docker/docker-compose.yml --project-directory .docker

.DEFAULT_GOAL:=help

.PHONY: help

help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)


##@ Docker

.PHONY: build
build: ## Build docker images
	$(COMPOSE) build

.PHONY: up
up: ## Start docker containers
	$(COMPOSE) up -d

.PHONY: down
down: ## Stop and remove docker containers/networks
	$(COMPOSE) down

.PHONY: start
start: ## Start docker containers
	$(COMPOSE) start

.PHONY: stop
stop: ## Stop docker containers
	$(COMPOSE) stop

.PHONY: workspace
workspace: ## Run workspace container as developer
	$(COMPOSE) run workspace /bin/bash

.PHONY: cs
cs: ## Run PHP Code sniffer
	php vendor/bin/phpcs

.PHONY: stan
stan: ## Run PHP Stan
	php vendor/bin/phpstan analyse -c phpstan.neon

.PHONY: phpunit
phpunit: ## Run PHPUnit with phpunit.xml config and autoload.php bootstrap
	php vendor/bin/phpunit -c ./phpunit.xml --bootstrap vendor/autoload.php