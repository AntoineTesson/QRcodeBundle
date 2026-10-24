# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.2] - 2026-10-24

### Fixed
- PHP 8.5: removed `imagedestroy()` calls in `DNS1D` and `DNS2D` (no effect since PHP 8.0,
  deprecated in 8.5).
- Tests: data providers declared with `#[DataProvider]` attributes (the test framework v12
  ignores the `@dataProvider` annotation, so both provider tests ran without arguments).
- CI: test matrix on PHP 8.3, 8.4 and 8.5 (the test framework v12.5, required by the CVE fix,
  needs PHP 8.3+).

## [2.1.1] - 2026-10-24

### Fixed
- PHP 8.5: `QRcode::getCode()` indexed its Reed-Solomon blocks with a float (`count / blocks`),
  which raised "Implicit conversion from float to int loses precision" thousands of times per
  QR code. It now uses `intdiv()`; the generated matrices are byte-for-byte identical (checked on
  24 codes, 6 texts × 4 error-correction levels, with a fixed random seed).

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
