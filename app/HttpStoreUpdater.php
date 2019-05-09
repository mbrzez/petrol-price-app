<?php

namespace App;


class HttpStoreUpdater
{
    protected $url;
    protected $api;
    protected $client;

    public function __construct($uri, $api, $client)
    {
        $this->uri = $uri;
        $this->api = $api;
        $this->client = $client;
    }

    public function update() {
        $response = $this->client->request('GET', $this->uri, [
            'query' => ['api-key' => $this->api]
        ]);

        $contents = $response->getBody()->getContents();
        $stores = json_decode($contents);

        foreach ($stores as $store) {
            AuchanStore::updateOrCreate(['external_id' => $store->store_id], [
                'name' => $store->post_title,
                'city' => $store->city,
                'latitude' => $store->latitude,
                'longitude' => $store->longitude,
                'sub_url' => $store->store_url_name->pl
            ]);
        }
    }
}