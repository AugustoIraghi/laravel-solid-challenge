<?php

namespace App\Services\Balance;

use App\Http\Requests\BalanceRequest;
use App\Models\Transaction;
use App\Services\Balance\BalanceServiceInterface;

class BalanceService implements BalanceServiceInterface
{
    public function calculateIncome(BalanceRequest $request): float
    {
        $query = $this->buildQuery($request);
        return $query->where('amount', '>', 0)->sum('amount');
    }

    public function calculateExpenses(BalanceRequest $request): float
    {
        $query = $this->buildQuery($request);
        return $query->where('amount', '<', 0)->sum('amount');
    }

    public function calculateTotal(BalanceRequest $request): float
    {
        $income = $this->calculateIncome($request);
        $expenses = $this->calculateExpenses($request);
        return $income + $expenses;
    }

    protected function buildQuery(BalanceRequest $request)
    {
        $query = Transaction::where('user_id', auth()->id());

        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);

        return $query;
    }
}
