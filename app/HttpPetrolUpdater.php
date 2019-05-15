<?php

namespace App;

use App\Mappers\PetrolPriceMapper;
use App\Utils\HttpClientUtils;

class HttpPetrolUpdater
{
    /**
     * Base url to Auchan API
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * API key to access restricted resource
     *
     * @var string
     */
    protected $apiKey;

    /**
     * GuzzleHttp REST client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var \App\Utils\HttpClientUtils
     */
    protected $httpUtils;


    /**
     * HttpStoreUpdater constructor.
     * @param string $baseUrl
     * @param string $apiKey
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(string $baseUrl, string $apiKey, \GuzzleHttp\Client $client)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->httpUtils = new HttpClientUtils($baseUrl, $apiKey);
    }

    /**
     * Updates PetrolPrice models
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return void
     */
    public function update(): void {
        $auchanStores = AuchanStore::all()->filter(function($store) {
            return $store->getAttribute('petrol_station') == true;
        });

        foreach ($auchanStores as $auchanStore) {
            $subUrl = $auchanStore->getAttribute('sub_url');
            $response = $this->client->request('GET',
                $this->httpUtils->getFullUrl($subUrl),
                $this->httpUtils->getQueryApiParams()
            );

            $contents = $response->getBody()->getContents();
            $store = json_decode($contents);

            if ($store->gasstation->state) {
                $petrolPrice = PetrolPriceMapper::create($store->gasstation->gas_types);
                $auchanStore->prices()->save($petrolPrice);
            }
        }
    }
}