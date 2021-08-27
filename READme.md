# Docs

## Setup
- Run `composer install`
- Set correct `DATABASE_URL` in `.env`
- Run `php bin/console doctrine:database:create`
- Run `php bin/console make:entity`
- Run `php bin/console make:migration`
- Run `php bin/console doctrine:migrations:migrate`
- Run `symfony serve`
- Enjoy