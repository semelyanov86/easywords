# EasyWords App

Self-hosted application which you can use for quickly learn new words. As backend this app uses Laravel 8 with php8, as frontend - Vue.js with vue-router. You can use this as PWA, mobile application is coming.

## 🚀 About Me
I'm a full stack developer. I like to create cool web services on modern technology stack: Laravel, Vue.js

## About EasyWords

![Logo](http://cards.sergeyem.test:8000/images/easywords-full.png)

This is simple project for fast learning of foreign words

## Tech Stack

**Client:** Vue.js, Vuex, Vue Router, TailwindCSS

**Server:** PHP8, Apache, Laravel 8, Mysql


## Acknowledgements

- [How to memorize new vocabulary faster: 9 tips](https://www.ef.com/wwen/blog/language/how-to-memorize-new-vocabulary-faster/)
- [26 Best Ways to Learn Vocabulary Words Fast and Effectively](https://content.wisestep.com/best-ways-learn-vocabulary-fast-effectively/)
- [What are the best ways to memorise new vocabulary?](https://www.youtube.com/watch?v=evTXudMf2M4)


## Installation

On server we use Apache, PHP 8, Mysql 8. Also you should use HTTPS in order to install PWA.

First, clone this project from git:

```bash
  git clone git@github.com:semelyanov86/easywords.git
```
Go to the project directory

```bash
  cd my-project
```

Then edit your .env file with DB credentials and other settings.

```bash
  cp .env.example .env
```

Then open .env file and edit settings for database and change url to your own value. More details see in **Environment Variables**

Install NPM if it is not installed yet:

```bash
  npm install
  mkdir var
```

Then install composer dependencies:

```bash
  composer install --no-dev
```

Fill out your database with seeders. Notice: seed is important, because it will create the first admin user for you and also will fill sample database for english and german words.

```bash
  php artisan migrate --seed
```

Then run additional support commands:

```bash
  php artisan key:generate
  php artisan storage:link
```

And that's it, go to your domain and login:

Default credentials
Username: `admin@admin.com`
Password: `password`

Project also have an admin panel. You can access it by `/admin` route.

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`APP_ENV` - set it to dev

`APP_DEBUG` - set it to false

`APP_URL` - put there your domain name

`DB_HOST` - set URL of database

`DB_PORT` - set port number of database

`DB_DATABASE` - set database name

`DB_USERNAME` - set database user

`DB_PASSWORD` - set database password

`SESSION_DOMAIN` - set your domain name

`SANCTUM_STATEFUL_DOMAINS` - set your domain name

## Features

- Admin page `/admin` where you can add or remove users, manage permissions and list of words of all users
- Learn foreign words using cards.
- Choose language you want to learn.
- See statistics and analytics data. Monitor your progress.
- Cross platform with PWA support.
- Native [android mobile application](https://easywordsapp.ru/apps/flutter_apk/app.apk)
- Manage most popular words. If user do not want to create words manually, he can import most popular words from samples table

## Running Tests

To run tests, run the following command

```bash
  vendor/bin/phpunit
```

## API Reference

Application has detail API documentation. You can access it by route: [/docs/index.html](/docs/index.html)

Also you can get insomnia collection. It is located in `public_html/docs/Insomnia_collection.yaml`

#### Get all words

```http
  GET /api/words
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `language` | `string` | **Required**. Language you want to learn |

#### Get word

```http
  GET /api/words/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of word to fetch |

#### Delete word

```http
  DELETE /api/words/${id}
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of word to delete |

#### Get profile info

```http
  GET /api/me
```

#### Get API key

```http
  POST /api/token
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. Email of user |
| `password`      | `string` | **Required**. User password |
| `device_name`      | `string` | **Required**. Name of device |


## Roadmap

- Add native application for Linux
- Add cloud app functionality


## Demo

You can check my article with demo functionality of this app: Link is coming...

## Screenshots

Here you can check some screenshot of this app

![App Screenshot](https://i.imgur.com/mUVQEJA.png)
![App Screenshot](https://i.imgur.com/Fk3LnPH.png)
![App Screenshot](https://i.imgur.com/m7SVj1y.png)
![App Screenshot](https://i.imgur.com/Y4cjXJe.png)
![App Screenshot](https://i.imgur.com/qTf2Htx.png)
![App Screenshot](https://i.imgur.com/06Fa4Xz.png)


## FAQ

#### Do you have mobile app?

For learning words through smartphones you can use PWA. Just open in Google Chrome you domain through HTTPS and install your website as an app.

Also I have a mobile application for android. You can download and install APK using this link: [https://easywordsapp.ru/apps/flutter_apk/app.apk](https://easywordsapp.ru/apps/flutter_apk/app.apk)

For more information visit repository of mobile application: [https://github.com/semelyanov86/easywords-native](https://github.com/semelyanov86/easywords-native)

#### Can I connect multiple users to my app?

Yes, it is support multiuser functionality. But for now registration from frontend is not supported. You can create new users through admin page.

#### Can I add support for new language?

Yes, just add new language code in `config/app.php` file, `supported_languages` array.

For example:
````php
    'supported_languages' => [
        'DE', 'EN', 'ES'
    ],
````
Then you will need to create file in folder `database/seeders/samples/ES.php` 

This file should contain array with sample data of most popular words.

Then run command `php artisan db:seed --class=SampleSeeder`

Using this steps you can see new language - ES with sample data which you can import.

## License

[MIT](https://choosealicense.com/licenses/mit/)


## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://sergeyem.ru/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/sergeyem)
[![facebook](https://img.shields.io/badge/facebook-1DA1F2?style=for-the-badge&logo=facebook&logoColor=white)](https://facebook.com/semelyanov86)

## Support

For support, email se@sergeyem.ru.


## Feedback

If you have any feedback, please reach out to us at se@sergeyem.ru

