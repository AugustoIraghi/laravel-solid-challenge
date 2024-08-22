<?php
function convertCurrency($amount, $currency)
{
    return \App\Facades\CurrencyFacade::convert($amount, $currency);
}