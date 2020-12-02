### install dependencies
composer install

### run migtations
bin/console doctrine:migrations:migrate

### run fixtures
bin/console doctrine:fixtures:load

### run tests
./vendor/bin/phpunit