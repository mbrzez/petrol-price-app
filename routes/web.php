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

use App\HttpStoreUpdater;
use GuzzleHttp\Client;


$router->group(['prefix' => 'api'], function() use ($router) {
    $router->get('petrol-prices', 'PetrolController@getAllPetrolPrices');
    $router->get('petrol-prices/{id}', 'PetrolController@getPetrolPricesForStore');
});