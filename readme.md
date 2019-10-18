# Petrol Price App
## Description
Petrol Price Application is deployed and available under http://petrolprice.hekko24.pl/

Idea of an application is to fetch and store petrol prices from public API used on [Auchan](https://www.auchan.pl/) website. Auchan is a brand of French supermarkets operating in Poland. Some of their shops sale petrol. Application twice per day will fetch petrol prices by PHP command `petrol-prices:update`. Command execution will be scheduled by Unix cron. Application was built using Lumen PHP framework and React.

PHP back-end can be found in `app` directory
React front-end can be found in `petrol-price-app/resources/assets`

## Running Webpack
Development
`npm run dev`
Production
`npm run prod`

## Running PHP
Before you start the application please configure `.env` file and run php artisan migrations beforehand. In `.env` please set `AUCHAN_API_KEY` and `AUCHAN_STORES_URI` keys with respective values. Without these key-value pairs applcation will not work. In order to run Lumen migrations please use `php artisan migrate` command. 
 
In order to run PHP build-in server use `php -S localhost:8000 -t public`.

Below Lumen artisan commands were implemented
`php artisan petrol-prices:update`
`php artisan auchan-stores:update`

The `auchan-stores:update` command can be run only once. It will fetch the list of all Auchan stores. Only supermarkets offering petrol will have special flag in a database. Then `petrol-prices:update` will collect all fuel prices. Petrol prices will be reflected in separate database table.