<?php


use Illuminate\Support\Str;

if (! function_exists('moneyFormat')) {
    /**
     * Format number as money with currency.
     *
     * @param  float|int|string  $amount
     * @param  string|null  $currency
     * @param  string|null  $locale
     * @return string
     */
    function moneyFormat($amount, $currency = 'BDT', $locale = 'en_BD')
    {
        // Ensure amount is numeric
        $amount = (float) $amount;

        // Use PHP intl NumberFormatter for proper currency symbol and format
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($amount, $currency);
    }
}

if (! function_exists('getSetting')) {
    /**
     * Get setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function getSetting($key, $default = null)
    {
        return \App\Models\Setting::where('key', $key)->first()?->value ?? $default;
    }
}
