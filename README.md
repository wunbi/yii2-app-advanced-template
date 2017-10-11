Yii 2 Advanced Project Template
===============================
Advanced Project Template for demo, include frontend and backend(with RBAC authorization),
just practice dont use in production.

[![Latest Stable Version](https://poser.pugx.org/rockielin/yii2-app-advanced-template/v/stable.png)](https://packagist.org/packages/rockielin/yii2-app-advanced-template)
[![Total Downloads](https://poser.pugx.org/rockielin/yii2-app-advanced-template/downloads.png)](https://packagist.org/packages/rockielin/yii2-app-advanced-template)

INSTALLATION
------------

You can choose to install the application using one of the following methods.

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:^1.3.1"
php composer.phar create-project --prefer-dist --stability=dev rockielin/yii2-app-advanced-template project-name
~~~

SETTING
------------
modify common/congif/main.php setting site domain, db information

modify common/congif/params.php setting optionals

Enable debug:
-------------
create file "develop.me" in /config/
