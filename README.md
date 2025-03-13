# Json Api Toolkit

[![Build Status](https://github.com/FreeElephants/json-api-dto/workflows/CI/badge.svg)](https://github.com/FreeElephants/json-api-dto/actions)
[![codecov](https://codecov.io/gh/FreeElephants/json-api-dto/branch/master/graph/badge.svg)](https://codecov.io/gh/FreeElephants/json-api-dto)
[![Installs](https://img.shields.io/packagist/dt/free-elephants/json-api-dto.svg)](https://packagist.org/packages/free-elephants/json-api-dto)
[![Releases](https://img.shields.io/packagist/v/free-elephants/json-api-dto.svg)](https://github.com/FreeElephants/json-api-dto/releases)

## Features: 

Build Data Transfer Objects from PSR7 Messages.

Full typed objects from request or response body.

See example in [test](/tests/FreeElephants/JsonApiToolkit/DTO/DocumentTest.php).

Union types support for relationships in PHP 8.


## Usage

Extend super types in your own json api documents and it's parts:
- \FreeElephants\JsonApi\DTO\AbstractAttributes
- \FreeElephants\JsonApi\DTO\AbstractDocument
- \FreeElephants\JsonApi\DTO\AbstractRelationships
- \FreeElephants\JsonApi\DTO\AbstractResourceObject

And use as properties types: 
- \FreeElephants\JsonApi\DTO\RelationshipToOne
- \FreeElephants\JsonApi\DTO\ResourceIdentifierObject

See tests/ for more examples.  

### Install

`composer require free-elephants/json-api-dto`

## Development

All dev env is dockerized. Your can use make receipts and `bin/` scripts without locally installed php, composer. 

For run tests with different php version change `PHP_VERSION` value in .env and rebuild image with `make build`.  
