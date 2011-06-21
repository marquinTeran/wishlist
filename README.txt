Copyright (c) 2011 Joseph Wynn
All rights reserved.

Wishlist is a multi-user web application for managing wishlists. It is built using the CodeIgniter framework (http://codeigniter.com/) and Doctrine ORM (http://doctrine-project.org/).

INSTALLING WISHLIST
1.	Open application/config/database.php and enter your database configuration.
2.	In a terminal, run the command "./application/doctrine orm:schema-tool:create" (Windows users should run "application/doctrine.php orm:schema-tool:create")

UPDATING AN EXISTING INSTALLATION OF WISHLIST
1.	In a terminal, run the command "./application/doctrine orm:schema-tool:update --force" (Windows users should run "application/doctrine.php orm:schema-tool:update --force")

TROUBLESHOOTING
Q.	Links do not go to the correct URL.
A.	Wishlist configures the base URL of the website based on your server's HTTP_HOST value. If you are experiencing problems with incorrect URLs, you may want to open application/config/config.php and change $config['base_url'].