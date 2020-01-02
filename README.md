# Croaker
Croaker is an open source PHP project management application built on the Symfony Framework.

_Croaker is currently in initial development. As such, some functionality, documentation and tests
may be missing._

While in initial development, the `master` branch contains all project files. Once Croaker is
in a stable state for initial release, the `master` branch will no longer include development files. I.e.
`phpunit.xml`, `.docker`, `Makefile`, etc...

## Getting Started

Croaker is intended to be fully compliant with 
[PSR-1](https://www.php-fig.org/psr/psr-1/),
[PSR-2](https://www.php-fig.org/psr/psr-2/),
 & [PSR-4](https://www.php-fig.org/psr/psr-4/)

## Prerequisites

* PHP 7.4+

## Documentation

More extensive documentation on Helpers is to be released soon. In the
meantime, all of the methods and properties are well documented within the
code base.

## Development

Docker containers are provided for development purposes. To use the containers,
copy `.docker/xdebug-DIST.ini` to `.docker/php-cli/xdebug.ini`
and update the respective values.

A `Makefile` is provided to assist in managing the containers as well as running
phpunit, php-cs, and phpstan within the workspace container.

From the project root directory, typing `make` on the command line will print available make commands.

Croaker is being developed on Debian Buster and as such any associated docker, make, etc. files have
not been tested in other environments.

## Authors

* **Jesse Rushlow** - *Lead developer* - [geeShoe Development](http://geeshoe.com)

Source available on [GitHub](https://github.com/geeshoe/php-croaker)

For questions, comments, or rant's, drop me a line at 
```
jr (at) geeshoe (dot) com
```