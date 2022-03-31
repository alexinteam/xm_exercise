<?php

namespace App\Http\Controllers;

use App\Libs\RapidApi\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoricalController extends Controller
{
    protected Client $rapidApiClient;

    public function __construct(Client $rapidApiClient)
    {
        $this->rapidApiClient = $rapidApiClient;
    }

    public function table(string $symbol, Request $request)
    {
        $startDate = Carbon::parse($request->get('startDate', null));
        $endDate = Carbon::parse($request->get('endDate', null));

        $data = [];
        if($startDate || $endDate) {
            $data = $this->rapidApiClient->getHistoricalData($startDate, $endDate, $symbol);
        }

        return view('table', [
            'data' => $data
        ]);
    }
}
