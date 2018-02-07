<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class CountryAvailabilityToIsActivePerLocale extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_LOCALIZED_ATTRIBUTES = 'localizedAttributes';
    const KEY_COUNTRY_AVAILABILITY = 'country_availability';
    const KEY_IS_ACTIVE_PER_LOCALE = 'is_active_per_locale';
    const KEY_DATA = 'data';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $countryAvailabilities = $value[static::KEY_COUNTRY_AVAILABILITY][0][static::KEY_DATA] ?? [];

        foreach ($value[static::KEY_LOCALIZED_ATTRIBUTES] as $locale => $attributes) {
            $value[static::KEY_LOCALIZED_ATTRIBUTES][$locale][static::KEY_IS_ACTIVE_PER_LOCALE] = $this->isAvailablePerLocale($locale, $countryAvailabilities);
        }

        return $value;
    }

    /**
     * @param string $locale
     * @param array $countryAvailabilities
     *
     * @return string
     */
    protected function isAvailablePerLocale(string $locale, array $countryAvailabilities): string
    {
        $country = strtolower(substr($locale, -2));

        return in_array($country, $countryAvailabilities) ? '1' : '0';
    }
}
