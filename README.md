# README #
- Project is build on [laravel 7.0](https://laravel.com/docs/7.x)
- Code Style: [PSR-2](https://www.php-fig.org/psr/psr-2)

## Requirements
- PHP >= 7.2.0
- Laravel 7.0
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [Larastan](https://github.com/nunomaduro/larastan)
- NodeJs and Npm

## How to check convention, analyze and phpunit code
**1**: Check conversion code
```
    composer cs-check
```

**2**: Analyze code
```
    composer analyse
```

**3**: Phpunit
```
    vendor/bin/phpunit
```

## How to build css, js frontend
```
    npm install
    npm run production
```
