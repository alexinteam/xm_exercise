<?php
namespace App\Libs\RapidApi;


use Carbon\Carbon;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Client
{
    public const GET_HISTORICAL_DATA_URL = '/stock/v3/get-historical-data';

    /**
     * @var HttpClient
     */
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param string $symbol
     * @return Collection
     */
    public function getHistoricalData(Carbon $startDate, Carbon $endDate, string $symbol) : Collection
    {
        $result = new Collection();
        try {
            $response = $this->httpClient->get('https://' . config('services.rapidapi.host') . '/' . self::GET_HISTORICAL_DATA_URL, [
                'headers' => [
                    'x-rapidapi-host' => config('services.rapidapi.host'),
                    'x-rapidapi-key' => config( 'services.rapidapi.key' ),
                    'useQueryString' => 'true',
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'symbol' => $symbol,
                ]
            ]);

            if ($response->getStatusCode() === 200 ) {
                $content = json_decode( $response->getBody()->getContents() );
                if ( is_object($content) && property_exists( $content, 'prices' ) ) {
                    foreach ($content->prices as $price) {
                        // TODO API Does not provide daterange
                        if(Carbon::parse($price->date)->between($startDate, $endDate)) {
                            $priceObj = new Price();
                            $priceObj->setDate(Carbon::parse($price->date));
                            $priceObj->setOpen(round((float)$price->open, 3));
                            $priceObj->setHigh(round((float)$price->high, 3));
                            $priceObj->setLow(round((float)$price->low, 3));
                            $priceObj->setClose(round((float)$price->close, 3));
                            $priceObj->setVolume(round((float)$price->volume,3));
                            $priceObj->setAdjclose(round((float)$price->adjclose,3));
                            $result->push($priceObj);
                        }
                    }

                    return $result;
                }
            }

            return $result;
        } catch (\Throwable $e) {
            Log::error('getHistoricalData failed: ' . $e->getMessage());

            return $result;
        }

    }
}
