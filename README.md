# chmod-resolver

Installation:
```
composer install
```

Usage:
```
php resolve.php [MODE] [WHO] [OPERATION]

php resolve.php 755 u x
php resolve.php 001 g r
php resolve.php 225 o w
```

Running tests:
```
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
```
