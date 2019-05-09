<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class HttpPetrolUpdater
{
    protected $baseUri;
    protected $api;
    protected $client;

    public function __construct($baseUri, $api, $client)
    {
        $this->baseUri = $baseUri;
        $this->api = $api;
        $this->client = $client;
    }

    public function update() {
        $stores = AuchanStore::all();

        foreach ($stores as $store) {
            $fullUri = $this->getFullUri($store->getAttribute("sub_url"));

            $response = $this->client->request('GET', $fullUri, [
                'query' => ['api-key' => $this->api]
            ]);

            $contents = $response->getBody()->getContents();
            $storeHttpData = json_decode($contents);

            if ($storeHttpData->gasstation->state && $storeHttpData->gasstation->display_prices) {
                $fuelPrices = $this->getPetrolPrices($storeHttpData->gasstation->gas_types);

                $petrolPrice = new PetrolPrice($fuelPrices);

                $store->prices()->save($petrolPrice);
            }
        }
    }

    private function getFullUri($subUri) {
        return $this->baseUri . '/' . $subUri;
    }

    private function getPetrolPrices($array) {
        foreach ($array as $item) {
            switch ($item->name) {
                case 'Pb95 (E5)':
                    $result['pb95'] = $item->price;
                    break;
                case 'Pb98 (E5)':
                    $result['pb98'] = $item->price;
                    break;
                case 'ON (B7)':
                    $result['diesel'] = $item->price;
                    break;
                case 'LPG':
                    $result['lpg'] = $item->price;
                    break;
            }
        }

        return $result;
    }
}