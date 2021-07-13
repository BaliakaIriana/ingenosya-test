Symfony Ingenosya Test
========================

The "Symfony Ingenosya Test" is a test application created for [Ingenosya][1].

Requirements
------------

  * PHP 7.4 or higher;
  * PDO-MySQL PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

[Download Symfony][4] to install the `symfony` binary on your computer, pull or download the source code and install dependancy

```bash
$ cd  ingenosya/
$ composer install
```

Database installation
------------
Create a database named `ingenosya` in MySQL and import the SQL file `ingenosya.sql` located at
```
ingenosya/database/ingenosya.sql
```


Usage
-----
- Configure your environnement file .env (Database, MailDSN, ...)

If you have [installed Symfony][4] binary, run this command:

```bash
$ cd  ingenosya/
$ symfony server:start
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.

[1]: https://www.ingenosya.com/
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
