<?php
namespace App\Services\Currency;

abstract class CurrencyDriver
{
    abstract protected function fetchRate($currency);

    public function getRate($currency)
    {
        // Add common logic here (e.g., error handling)
        return $this->fetchRate($currency);
    }
}

// XML Driver
class XMLCurrencyDriver extends CurrencyDriver
{
    protected function fetchRate($currency)
    {
        // Implement XML parsing logic
    }
}

// JSON Driver
class JSONCurrencyDriver extends CurrencyDriver
{
    protected function fetchRate($currency)
    {
        // Implement JSON parsing logic
    }
}

// CSV Driver
class CSVCurrencyDriver extends CurrencyDriver
{
    protected function fetchRate($currency)
    {
        // Implement CSV parsing logic
    }
}

// Average Driver
class AverageCurrencyDriver extends CurrencyDriver
{
    protected $drivers;

    public function __construct($drivers)
    {
        $this->drivers = $drivers;
    }

    protected function fetchRate($currency)
    {
        $rates = [];
        foreach ($this->drivers as $driver) {
            $rates[] = $driver->getRate($currency);
        }
        return array_sum($rates) / count($rates);
    }
}
