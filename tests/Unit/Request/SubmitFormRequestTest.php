<?php

namespace Request;

use Illuminate\Support\Facades\Validator;
use App\Http\Request\SubmitFormRequest;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class SubmitFormRequestTest extends TestCase
{
    use AdditionalAssertions;

    public function testFormRequest()
    {
        $request = new SubmitFormRequest();
        $data = [];
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());

        $data = [
            'email' => 'test@test.com'
        ];
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());


        $data = [
            'email' => 'test@test.com',
            'symbol' => 'AAAA'
        ];
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());


        $data = [
            'email' => 'test@test.com',
            'symbol' => 'AAAA',
            'dateStart' => '1999-01-01'
        ];
        $validator = Validator::make($data, $request->rules());
        $this->assertTrue($validator->fails());

        $data = [
            'email' => 'test@test.com',
            'symbol' => 'AAAA',
            'dateStart' => '1999-01-01',
            'dateEnd' => '1999-01-01',
        ];
        $validator = Validator::make($data, $request->rules());
        $this->assertFalse($validator->fails());

        $this->assertExactValidationRules([
            'email' => 'required|email',
            'symbol' => 'required|string|min:1|max:5',
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date',
        ], $request->rules());
    }
}
