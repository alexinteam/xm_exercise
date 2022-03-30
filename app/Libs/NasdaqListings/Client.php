<?php
namespace App\Libs\NasdaqListings;


use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getNasdaqListedJson()
    {
        $this->httpClient->get(config('services.nasdaqListings.url'), [
            'headers' => [
                'x-rapidapi-host' => config( 'services.rapidapi.host' ),
                'x-rapidapi-key' => config( 'services.rapidapi.key' ),
                'useQueryString' => 'true',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
