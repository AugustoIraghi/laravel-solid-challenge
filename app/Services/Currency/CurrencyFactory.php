<?php

namespace App\Services\Currency;

class CurrencyFactory
{
    public static function createDriver($type)
    {
        switch ($type) {
            case 'xml':
                return new XMLCurrencyDriver();
            case 'json':
                return new JSONCurrencyDriver();
            case 'csv':
                return new CSVCurrencyDriver();
            case 'average':
                return new AverageCurrencyDriver([
                    new XMLCurrencyDriver(),
                    new JSONCurrencyDriver(),
                    new CSVCurrencyDriver()
                ]);
        }
    }
}
