<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterService
{
    /**
     * Apply filters to the query based on provided filter rules.
     *
     * @param Builder $query
     * @param array $filterRules
     * @return Builder
     */
    public function applyFilters(Builder $query, array $filterRules)
    {
        foreach ($filterRules as $filter => $value) {
            if (method_exists($this, $filter)) {
                $query = $this->{$filter}($query, $value);
            }
        }

        return $query;
    }
    protected function type(Builder $query, $type) {}
    protected function amount(Builder $query, $amount) {}
    protected function date(Builder $query, $date) {}
}
