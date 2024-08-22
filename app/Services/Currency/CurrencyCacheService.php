<?php

namespace App\Services\Currency;

use Illuminate\Support\Facades\Cache;

class CurrencyCacheService
{
    public function getRate($currency, $driver)
    {
        return Cache::remember("currency_rate_{$currency}_{$driver}", 300, function () use ($currency, $driver) {
            return CurrencyFactory::createDriver($driver)->getRate($currency);
        });
    }

    public function resetRate($currency, $driver)
    {
        Cache::forget("currency_rate_{$currency}_{$driver}");
    }
}
