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
