<?php

namespace App\Strategies;

use App\Models\Transaction;

interface NotificationStrategy
{
    public function send(Transaction $transaction);
}
