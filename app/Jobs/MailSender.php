<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    private string $email;

    private string $dateStart;

    private string $dateEnd;

    private string $symbol;

    /**
     * @param $email
     * @param $symbol
     * @param $dateStart
     * @param $dateEnd
     */
    public function __construct($email, $symbol, $dateStart, $dateEnd)
    {
        $this->email = $email;
        $this->symbol = $symbol;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    public function handle(): bool
    {
        try {
            Mail::send('email', [
                'dateStart' => $this->dateStart,
                'dateEnd' => $this->dateEnd,
                'symbol' => $this->symbol
            ], function($message) {
                $message->to($this->email)->subject('Company Symbol = ' . $this->symbol);
            });

            return true;
        } catch (\Throwable $e) {
            Log::error('email to ' . $this->email . ' was not sent. ' . $e->getMessage());
            return false;
        }
    }
}
