<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Deck-Cards Application

<h3>Installation</h3> - 

Take a clone of repository and update the composer by -
```
        $ composer update
```
<h5> For NGINX Server </h5>

Go to config file of NGINX server add path to public - 
```
        $ sudo vim /etc/nginx/sites-available/default
```

Create a Database name deck-cards by following commands - 
```
        $ mysql -u root -p
        $ CREATE DATABASE deck-cards;
```
Add the password of database in .env file in the stack

Run migrate command to create tables in the application and seeder data.
```
        $ php artisan migrate
```
Give permission to profile_images folder in the public folder to save images.
```
        $ sudo chmod 777 -R public/profile_images/
```
<h5>Please ensure that server has permission to add images more than 1MB. </h5>

Modify NGINX Configuration File.
```
        $ sudo vim /etc/nginx/nginx.conf
```
Search for this variable: client_max_body_size. If you find it, just increase its size to 100M, for example. If it doesn’t exist, then you can add it inside and at the end of http

```
        $ client_max_body_size 100M;
```

Restart nginx to apply the changes.
```
        $ sudo service nginx restart
```

Modify PHP.ini File for Upload Limits

It’s not needed on all configurations, but you may also have to modify the PHP upload settings as well to ensure that nothing is going out of limit by php configurations.

If you are using PHP5-FPM use following command,
```
        $ sudo vim /etc/php5/fpm/php.ini
```

If you are using PHP7.0-FPM use following command,
```
        $ sudo vim /etc/php/7.0/fpm/php.ini
```
Now find following directives one by one
```
        upload_max_filesize
        post_max_size
```
and increase its limit to 100M, by default they are 8M and 2M.
```
        upload_max_filesize = 100M
        post_max_size = 100M
```

Finally save it and restart PHP.
PHP5-FPM users use this,
```
        sudo service php5-fpm restart
```


PHP7.0-FPM users use this,
```
        sudo service php7.0-fpm restart
```

<i>Note</i>: If you could not fix the image 'Entity too large issue' then we have given small size images in the public/profile_images folder.

<b> Setup Done </b>

