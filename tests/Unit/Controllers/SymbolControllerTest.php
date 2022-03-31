<?php

namespace Tests\Unit\Controllers;

use App\Http\Request\SubmitFormRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class SymbolControllerTest extends TestCase
{
    public function testForm()
    {
        $response = $this->get('form');

        $response->assertStatus(200);
    }

    public function testSubmitForm()
    {
        $symbol = 'AAIT';
        $dateStart = '2022-03-01';
        $dateEnd = '2022-03-31';

        $response = $this->post('form', [
            'email' => 'test@test.com',
            'symbol' => 'AAIT',
            'dateStart' => '2022-03-01',
            'dateEnd' => '2022-03-31',
        ]);

        $response->assertRedirect(route('table_page', [
            'symbol' => $symbol,
            'startDate' => $dateStart,
            'endDate' => $dateEnd,
        ]));
    }
}
