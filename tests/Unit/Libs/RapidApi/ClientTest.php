<?php

namespace Libs\RapidApi;

use App\Libs\RapidApi\Client;
use App\Libs\RapidApi\Price;
use Carbon\Carbon;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetHistoricalData()
    {
        $httpClient = new \GuzzleHttp\Client();
        $client = new Client($httpClient);
        $endDate = Carbon::now();
        $startDate = Carbon::now()->addYears(-1);
        $symbol = 'AAIT';
        $response = $client->getHistoricalData($startDate, $endDate, $symbol);
        $this->assertTrue(count($response) > 0);

        $item = $response[0];
        $this->assertInstanceOf(Price::class, $item);
    }
}
