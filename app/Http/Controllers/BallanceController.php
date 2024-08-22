<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Services\Balance\BalanceServiceInterface;

class BallanceController extends Controller
{
    protected $balanceService;

    public function __construct()
    {
        $this->balanceService = new BalanceServiceInterface();
    }
    public function show(BalanceRequest $request)
    {
        $income = $this->balanceService->calculateIncome($request);
        $expenses = $this->balanceService->calculateExpenses($request);
        $total = $this->balanceService->calculateTotal($request);

        return response()->json([
            'income' => $income,
            'expenses' => $expenses,
            'total' => $total,
        ]);
    }
}
