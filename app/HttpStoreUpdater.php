<?php

namespace App;

use App\Utils\HttpClientUtils;
use Illuminate\Support\Facades\Log;

class HttpStoreUpdater
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
     * Updates AuchanStore models
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(): void {
        $storesSummaryResponse = $this->client->request('GET', $this->baseUrl, $this->httpUtils->getQueryApiParams());

        $storesSummaryContents = $storesSummaryResponse->getBody()->getContents();
        $storesSummaryInfo = json_decode($storesSummaryContents);

        foreach ($storesSummaryInfo as $storeSummaryInfo) {
            $auchanStore = AuchanStore::updateOrCreate(['external_id' => $storeSummaryInfo->store_id], [
                'name' => $storeSummaryInfo->post_title,
                'city' => $storeSummaryInfo->city,
                'latitude' => $storeSummaryInfo->latitude,
                'longitude' => $storeSummaryInfo->longitude,
                'sub_url' => $storeSummaryInfo->store_url_name->pl,
            ]);

            $this->updatePetrolStationField($auchanStore);
        }
    }

    /**
     * Updates petrol station field for AuchanStore models
     *
     * @param AuchanStore $auchanStore
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updatePetrolStationField(AuchanStore $auchanStore): void {
        $hasStation = false;
        $subUrl = $auchanStore->getAttribute("sub_url");

        try {
            $fullStoreResponse = $this->client->request('GET',
                $this->httpUtils->getFullUrl($subUrl),
                $this->httpUtils->getQueryApiParams()
            );

            $fullStoreContents = $fullStoreResponse->getBody()->getContents();
            $fullStoreInfo = json_decode($fullStoreContents);
            $hasStation = $fullStoreInfo->gasstation->state ? true : false;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        } finally {
            $auchanStore->setAttribute('petrol_station', $hasStation);
            $auchanStore->save();
        }
    }
}