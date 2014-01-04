Wishlist is a multi-user web application for managing wishlists. It is built using the [CodeIgniter framework](http://codeigniter.com/) and [Doctrine ORM](http://doctrine-project.org/).

## REQUIREMENTS
PHP 5.3.0+
MySQL 5.0+
[APC](http://php.net/manual/en/book.apc.php) is recommended to greatly improve performance, except on php 5.5 
where you should use the [opcache extension](http://uk3.php.net/opcache)

## INSTALLING WISHLIST
1.	Open `application/config/database.php` and enter your database configuration.
2.	In a terminal, run the command `./application/doctrine orm:schema-tool:create`
	(Windows users should run `application/doctrine.php orm:schema-tool:create`)

## UPDATING AN EXISTING INSTALLATION OF WISHLIST
1.	In a terminal, run the command `./application/doctrine orm:schema-tool:update --force`
	(Windows users should run `application/doctrine.php orm:schema-tool:update --force`)

## TROUBLESHOOTING
Q.	Links do not go to the correct URL.

A.	Wishlist configures the base URL of the website based on your server's `HTTP_HOST` value.
	If you are experiencing problems with incorrect URLs, you may want to open `application/config/config.php` and change `$config['base_url']`.

Q.	I want to use a different database system like PostgreSQL, SQLite, etc

A.	If you don't want to use MySQL, open `./application/libraries/Doctrine.php` and change `$connectionOptions['driver']` to [whichever driver you like](http://php.net/manual/en/pdo.drivers.php).
