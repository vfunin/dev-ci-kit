[![Total Downloads](https://poser.pugx.org/vfunin/dev-ci-kit/downloads.png)](https://packagist.org/packages/vfunin/dev-ci-kit)
[![Build status](https://github.com/vfunin/dev-ci-kit/workflows/build/badge.svg)](https://github.com/vfunin/dev-ci-kit/actions?query=workflow%3Abuild)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fvfunin%2Fdev-ci-kit%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/vfunin/dev-ci-kit/master)
[![codecov](https://codecov.io/gh/vfunin/dev-ci-kit/branch/master/graph/badge.svg?token=ER6NMU4XDO)](https://codecov.io/gh/vfunin/dev-ci-kit)
[![psalm-level](https://shepherd.dev/github/vfunin/dev-ci-kit/level.svg)](https://shepherd.dev/github/vfunin/dev-ci-kit)
[![type-coverage](https://shepherd.dev/github/vfunin/dev-ci-kit/coverage.svg)](https://shepherd.dev/github/vfunin/dev-ci-kit)


# Dev CI Kit

The package provides a pre-configured set of code quality checking tools based on [GrumPHP](https://github.com/phpro/grumphp/).

## Requirements

- php
- git
- composer
- xdebug (optional) - for code coverage and mutation testing.

## Installation
Install Dev CI Kit with dependencies:
```sh
composer require --dev vfunin/dev-ci-kit
```
After installation, configuration file templates will be copied to your project's root directory with a .dist extension. If your project does not already have the corresponding file, simply remove the extension, or use your own configuration.

#### Important
If the `./app` or `/src` directories do not exist in your project, you should remove the corresponding checks from the [phpunit.xml](phpunit.xml), [psalm.xml](psalm.xml), [rector.php](rector.php), [phpcs.xml](phpcs.xml), [infection.json](infection.json) and [deptrac.yaml](deptrac.yaml). 

## Basic usage
Since the package is built on [GrumPHP](https://github.com/phpro/grumphp/), its usage is entirely identical:
```sh
vendor/bin/grumphp run
```
Or simply commit some changes because "GrumPHP is sniffing your commits" :) 

Also, feel free to use tools individually for spot-checking, like
```sh
vendor/bin/infection
```

And of course, you can modify the GrumPHP configuration in the `grumphp.yml` file. For example, you can disable tasks by simply removing them from `testsuites: * : tasks:`.

## About

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/vfunin/dev-ci-kit/issues).

### License

Dev CI Kit is licensed under the [MIT License](LICENSE).
