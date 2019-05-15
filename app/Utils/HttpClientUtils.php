<?php


namespace App\Utils;


class HttpClientUtils
{
    /**
     * Base URL
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

    public function __construct(string $baseUrl, string $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    /**
     * Returns a full URI as string
     *
     * @return string
     */
    public function getFullUrl($subUrl): string {
        return $this->baseUrl . '/' . $subUrl;
    }

    /**
     * Returns Http client params
     *
     * @return array
     */
    public function getQueryApiParams(): array {
        return [
            'query' => ['api-key' => $this->apiKey]
        ];
    }
}