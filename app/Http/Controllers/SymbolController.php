<?php

namespace App\Http\Controllers;

use App\Http\Request\SubmitFormRequest;
use App\Jobs\MailSender;
use App\Libs\NasdaqListings\Client;
use Carbon\Carbon;


class SymbolController extends Controller
{
    protected Client $nasdaqClient;

    public function __construct(Client $nasdaqClient)
    {
        $this->nasdaqClient = $nasdaqClient;
    }

    public function form()
    {
        return view('form', [
            'symbols' => $this->nasdaqClient->getNasdaqListedJson()
        ]);
    }

    public function submitForm(SubmitFormRequest $request)
    {
        $dateEnd = Carbon::parse($request->get('dateEnd'))->format('Y-m-d');
        $dateStart = Carbon::parse($request->get('dateStart'))->format('Y-m-d');
        $symbol = $request->get('symbol');
        $email = $request->get('email');

        $resultMailSent = MailSender::dispatchSync($email, $symbol, $dateStart, $dateEnd);

        return redirect(route('table_page', [
            'symbol' => $symbol,
            'startDate' => $dateStart,
            'endDate' => $dateEnd,
        ]))->with('EmailSuccess', $resultMailSent);
    }
}
