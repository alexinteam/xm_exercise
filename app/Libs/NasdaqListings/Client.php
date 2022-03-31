<?php
namespace App\Libs\NasdaqListings;


use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Client
{
    public const LIST_CACHE_KEY = 'nasdaq_list';

    /**
     * @var HttpClient
     */
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getNasdaqListedJson() : Collection
    {
        try {
            if($result = Cache::get(self::LIST_CACHE_KEY)) {
                return $result;
            } else {
                $result = new Collection();
                $response = $this->httpClient->get(config('services.nasdaqListings.url'));
                $response = \GuzzleHttp\Utils::jsonDecode($response->getBody());
                if ($response && is_array($response)) {
                    foreach ($response as $responseItem) {
                        $company = new Company();
                        $company->setSymbol($responseItem->Symbol);
                        $result->push($company);
                    }
                }

                if(count($result)) {
                    Cache::put(self::LIST_CACHE_KEY, $result, 60);
                }

                return $result;
            }
        } catch (\Throwable $e) {
            Log::error('getNasdaqListedJson failed: ' . $e->getMessage());
            return new Collection();
        }
    }
}
