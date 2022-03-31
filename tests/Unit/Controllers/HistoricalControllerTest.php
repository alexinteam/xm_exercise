<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;

class HistoricalControllerTest extends TestCase
{
    public function testTable()
    {
        $response = $this->get('table/AAIT');

        $response->assertStatus(200);
    }
}
