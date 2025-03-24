# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.0.5] - 2025-03-24

### Fixed
- Check nullable input id value in Resource Object

## [0.0.4] - 2025-03-20

### Changed
- AbstractResourceObject::$id may be nullable for server-side id generation.

## [0.0.3] - 2025-03-18

### Added
- Handle nullable objects

## [0.0.2] - 2025-03-14

### Added
- AbstractCollection for handle array of resources in data field
- Exception on pass array as data into AbstractDocument constructor

## [0.0.1] - 2025-03-13

### Added
- Extract all DTO types from FreeElephants/json-api-php-toolkit to this project

[Unreleased]: https://github.com/FreeElephants/json-api-dto/compare/0.0.5...HEAD
[0.0.5]: https://github.com/FreeElephants/json-api-dto/releases/tag/0.0.5
[0.0.4]: https://github.com/FreeElephants/json-api-dto/releases/tag/0.0.4
[0.0.3]: https://github.com/FreeElephants/json-api-dto/releases/tag/0.0.3
[0.0.2]: https://github.com/FreeElephants/json-api-dto/releases/tag/0.0.2
[0.0.1]: https://github.com/FreeElephants/json-api-dto/releases/tag/0.0.1
