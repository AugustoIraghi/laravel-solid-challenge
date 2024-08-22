<?php

namespace App\Strategies;

use App\Models\Transaction;
use App\Mail\TransactionCreated;
use Illuminate\Support\Facades\Mail;

class EmailNotificationStrategy implements NotificationStrategy
{
    public function send(Transaction $transaction)
    {
        Mail::to($transaction->user->email)->send(new TransactionCreated($transaction));
    }
}
