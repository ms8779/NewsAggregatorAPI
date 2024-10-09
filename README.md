
## News Aggregator API

RESTful API for a news aggregator service that pulls articles from various
sources and provides endpoints for a frontend application to consume.

Link: [API Documentation](https://app.swaggerhub.com/apis/MS8779I/NewsAggregatorAPI/1.0.0).

### Setup

#### Overview

This API is build using Docker. docker-compose.yml is provided in route directory. 
You can use laravel/sail or simply docker-compose. You also need to provide API keys
for fetching news to online news sources. I use New York Time, The Guardian 
and NewsOrg source API's for it. So you have to provide API access keys for all three
sources in .env file. More over you can also change and set default parameters related to database. 
These parameters names are provided in .env.example. You can copy the file, 
rename it to .env and then change the parameters values in .env file. 

### Requirements
- You must have installed Docker, Docker Compose.
- If you do not want to use laravel/sail You must also have installed php
- You must have installed Composer

### .env
 - create a .env file by copying and renaming .env.example file.
 - Set values for
- ##### Required
   - THE_GUARDIAN_KEY=
   - NEW_YORK_TIMES_KEY=
   - NEWS_ORG_KEY=

- ##### Default can be changed

  - DB_HOST=database
  - DB_PORT=3306
  - DB_DATABASE=news_aggregator
  - DB_USERNAME=root
  - DB_PASSWORD=

    

### Commands
- run command "composer install". This will install all packages including "laravel/sail" the packages
- run command "./vendor/bin/sail up". If you want to use laravel/sail for docker.
- run command "docker-compose up". In case you do not want to use laravel/sail.
- run command "./vendor/bin/sail artisan migrate". In case you are using Sail
- run command "php artisan migrate". In case not using laravel Sail
- run command "php artisan queue:work or ./vendor/bin/sail artisan queue:work"
- run command "php artisan app:fetch-news" or respected command for laravel Sail. 
This will fetch the news from all three sources and put them in to database.

## Congratulation
News Aggregator API setup completed. You can now use it according to the 
documentation linked above at start

## Extras
There are also provided db seeder to seed fake data in database. You can run
"php artisan db:seed" to put fake data in to database. This will also add default user
with following credentials you can use.

Email: [admin@newsaggregator.com]()

Password: [admin@321]()

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
