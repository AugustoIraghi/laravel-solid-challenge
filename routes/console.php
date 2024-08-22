<?php

use App\Services\Currency\CurrencyCacheService;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $service = new CurrencyCacheService();
    $currencies = ['USD', 'EUR'];
    foreach ($currencies as $currency) {
        $service->getRate($currency, 'xml');
        $service->getRate($currency, 'json');
        $service->getRate($currency, 'csv');
    }
})->everyFiveMinutes();
