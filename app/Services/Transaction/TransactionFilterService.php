<?php

namespace App\Services;

use App\Services\FilterService;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilterService extends FilterService
{
    /**
     * Filter by type (income/expense).
     *
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    protected function type(Builder $query, $type)
    {
        return $query->where('amount', $type === 'expense' ? '<' : '>', 0);
    }

    /**
     * Filter by amount.
     *
     * @param Builder $query
     * @param float $amount
     * @return Builder
     */
    protected function amount(Builder $query, $amount)
    {
        return $query->where('amount', '>=', $amount);
    }

    /**
     * Filter by date.
     *
     * @param Builder $query
     * @param string $date
     * @return Builder
     */
    protected function date(Builder $query, $date)
    {
        return $query->whereDate('created_at', $date);
    }
}
