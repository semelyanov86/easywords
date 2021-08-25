## About Easywords

This is simple project for fast learning of foreign words

### Installation instruction

On server we use Apache, PHP 8, Mysql 8.

After pulling project, you need to do following:

* Extract the archive and put it in the folder you want
* Run cp .env.example .env file to copy example file to .env
Then edit your .env file with DB credentials and other settings.
* Run npm install to download node_modules folder
* Create var folder
* Run composer install command
* Run php artisan migrate --seed command. Notice: seed is important, because it will create the first admin user for you.
* Run php artisan key:generate command.
* If you have file/photo fields, run php artisan storage:link command.

And that's it, go to your domain and login:
Default credentials
Username: `admin@admin.com`
Password: `password`


