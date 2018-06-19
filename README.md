# JugglingServer

##Launche
* First time install dependencies

`composer install`

* Then each other times launch server with minimum php7

`php bin/console server:start`
## Develop
To add entity : -php bin/console make:entity
		- php bin/console make:migration
		- php bin/console doctrine:migrations:migrate
		- php bin/console make:controller
