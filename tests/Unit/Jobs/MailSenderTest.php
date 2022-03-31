<?php

namespace Tests\Unit\Jobs;

use App\Jobs\MailSender;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class MailSenderTest extends TestCase
{
    public function test_mail_was_sent()
    {
        Bus::fake();
        MailSender::dispatch('test@test.com', '1970-01-01', '1970-01-01', 'QQQ');
        Bus::assertDispatched(MailSender::class, function ($job) {
            return $job->getEmail() === 'test@test.com';
        });
    }
}
