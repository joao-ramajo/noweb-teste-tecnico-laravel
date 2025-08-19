<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService
{
    public function __construct(
        private string $channel
    ){}

    public function error(string $message): void
    {
        Log::channel($this->channel)->error($message);
    }

    public function info(string $message): void
    {
        Log::channel($this->channel)->info($message);
    }
}