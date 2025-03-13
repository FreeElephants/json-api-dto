PATH := $(shell pwd)/bin:$(PATH)
$(shell cp -n dev.env .env)
include .env

.PHONY: build
build:
	docker build --build-arg PHP_VERSION=$(PHP_VERSION) -t $(PHP_DEV_IMAGE) .

.PHONY: install
install: build
	composer install

.PHONY: test
test:
	./bin/php vendor/bin/phpunit

