<?php

namespace App\Services\Balance;

use App\Http\Requests\BalanceRequest;
use Illuminate\Http\Request;

interface BalanceServiceInterface
{
    public function calculateIncome(BalanceRequest $request): float;
    public function calculateExpenses(BalanceRequest $request): float;
    public function calculateTotal(BalanceRequest $request): float;
}
