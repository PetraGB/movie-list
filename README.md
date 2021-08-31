## Docs

Hello, this is movies CRUD app

```
Create basic CRUD web application (with frontend UI) "My movies list":
[*] users should be able to add/read/update/delete a new movie to the database
[*] [optionally] add Authentication to your app
[*] [optionally] add Authorization  to your app

Feel free to use your preferred tools, 
that you are familiar with on day-to-day basis (if not please comment your decision).

As the time is limited and this is only a proof-of-concept test, 
comment on the possible ways to further improve/evolve your application as if it was a real product.
```

## Tech

* PHP7
* Symfony 5
* Doctrine ORM

## Launch

- Checkout this git repo
- Run `composer install`
- Run MySQL DB container
  - `docker run -it --network host -e MYSQL_ROOT_PASSWORD=test123 mysql:8`
- Set correct `DATABASE_URL` in `.env` if needed
- Run `php bin/console doctrine:database:create`
- Run `php bin/console make:migration`, answer `yes`
- Run `wget https://get.symfony.com/cli/installer -O - | bash`
- Run `~/.symfony/bin/symfony serve`
- Open `http://127.0.0.1:8000/register` and register
- Open `http://127.0.0.1:8000/movies` or `http://127.0.0.1:8000/login`

## MySQL

Default connection to DB
`mysql -h127.0.0.1 -ptest123 -uroot movies`