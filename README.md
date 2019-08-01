# Location challenge

## Prerequisites

- [docker](https://www.docker.com/)
- [docker-compose](https://docs.docker.com/compose/)
- [make](https://www.gnu.org/software/make/)
- `sh`

## Configuration
In order to create configuration files please go througth these steps:
1. Go to the root folder of the project
2. Run `cp ./location-service/app/config.dist.php ./location-service/app/config.php`
3. Run `cp ./web/js/config.dist.js ./web/js/config.js`
4. In the newly created files please embed your `google api key`

## How to run

1. From the root folder of the project please run `make build`.
2. Go to `location-service` folder and run 
   `make ssh`.
3. From the container please run `vendor/bin/phinx migrate && vendor/bin/phinx seed:run`
4. Api will be available at `localhost:8080`
5.  Web service is available at `locathost:8889`
