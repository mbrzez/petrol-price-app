<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/store', function () use ($router) {
    $attributes = [
        'name' => 'Auchan Rumia',
        'city' => 'Rumia',
        'latitude' => 54.5863375,
        'longitude' => 18.3711997,
        'url' => 'http://example.com/url',
        'petrol_station' => true
    ];

    //$store = new App\AuchanStore($attributes);
    //$store->save();

    $store = App\AuchanStore::find(1)->prices;

    return $store;
});

$router->get('/petrol', function () use ($router) {
    $attributes = [
        'pb95' => 5.12,
        'pb98' => 5.30,
        'diesel' => 5.10,
        'lpg' => 2.02,
        'store_id' => 1
    ];

    $price = new App\PetrolPrice($attributes);
    $price->save();

    return $price->store;
});