# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-02-01

### Added
- Support for Symfony 8.0
- Support for Symfony 7.x
- PHP 8.2+ strict typing with `declare(strict_types=1)`
- PHPUnit 10/11 support
- `is_safe` option on Twig function for proper HTML escaping

### Changed
- Minimum PHP version is now 8.2
- Minimum Symfony version is now 6.4 LTS
- Modernized code with readonly properties and constructor promotion
- Twig extension now returns string instead of using echo
- Generator uses private constants instead of protected properties
- Cleaned up Configuration class (removed legacy Symfony 4.1 compatibility code)

### Removed
- Support for PHP < 8.2
- Support for Symfony < 6.4
- Legacy compatibility code for older Symfony versions
- Travis CI configuration (use GitHub Actions instead)

### Fixed
- Twig function now properly returns value instead of echoing

## [1.2.12] - Previous releases

See GitHub releases for previous changelog entries.
