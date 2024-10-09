
## News Aggregator API

RESTful API for a news aggregator service that pulls articles from various
sources and provides endpoints for a frontend application to consume.

Link: [API Documentation](https://app.swaggerhub.com/apis/MS8779I/NewsAggregatorAPI/1.0.0).

### Setup

#### Overview

This API is build using Docker. docker-compose.yml is provided in route directory. 
You can use laravel/sail or simply docker-compose. 
### Requirements
- You must have installed Docker, Docker Compose.
- If you do not want to use laravel/sail You must also have installed php
- You must have installed Composer
    

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
