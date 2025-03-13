PATH := $(shell pwd)/bin:$(PATH)
$(shell cp -n dev.env .env)
include .env

build:
	docker build --build-arg PHP_VERSION=$(PHP_VERSION) -t $(PHP_DEV_IMAGE) .

install: build
	composer install

test:
	./bin/php vendor/bin/phpunit

