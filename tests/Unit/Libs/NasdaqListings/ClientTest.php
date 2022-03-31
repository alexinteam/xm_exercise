<?php

namespace Libs\NasdaqListings;

use App\Libs\NasdaqListings\Client;
use App\Libs\NasdaqListings\Company;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetNasdaqListedJson()
    {
        $httpClient = new \GuzzleHttp\Client();
        $client = new Client($httpClient);
        $response = $client->getNasdaqListedJson();
        $this->assertTrue(count($response) > 0);

        $item = $response[0];
        $this->assertInstanceOf(Company::class, $item);

        $this->assertNotEmpty($item->getSymbol());
    }
}
