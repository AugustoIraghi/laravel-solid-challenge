<?php

namespace App\Strategies;

use Illuminate\Support\Facades\Log;

class DatabaseLoggingStrategy implements LoggingStrategy
{
    public function log($transaction)
    {
        Log::info('Transaction created: ' . $transaction->id);
    }
}
