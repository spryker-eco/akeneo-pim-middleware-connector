<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class PriceSelector extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_LOCALE = 'locale';
    const KEY_DATA = 'data';
    const KEY_AMOUNT = 'amount';

    const KEY_PRICE = 'price';
    const KEY_CURRENCY = 'currency';
    const KEY_PRICE_TYPE = 'type';

    const LOCALE_TO_PRICE_TYPE_MAP = [
        'de_AT' => [
            self::KEY_CURRENCY => 'EUR',
            self::KEY_PRICE_TYPE => 'AT',
        ],
        'de_DE' => [
            self::KEY_CURRENCY => 'EUR',
            self::KEY_PRICE_TYPE => 'DE',
        ],
        'de_CH' => [
            self::KEY_CURRENCY => 'CHF',
            self::KEY_PRICE_TYPE => 'CH',
        ],
        'fr_FR' => [
            self::KEY_CURRENCY => 'EUR',
            self::KEY_PRICE_TYPE => 'FR',
        ],
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @throws \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException
     *
     * @return mixed
     */
    public function translate($value, array $payload): array
    {
        if ($value === null) {
            throw new MissingPriceException();
        }

        //@todo turn this in gross prices (requires tax rate, from secondary pipeline?)

        $result = [];

        foreach ($value as $priceInfo) {
            $locale = $priceInfo[static::KEY_LOCALE];
            if (!array_key_exists($locale, static::LOCALE_TO_PRICE_TYPE_MAP)) {
                continue;
            }

            $currency = static::LOCALE_TO_PRICE_TYPE_MAP[$locale][static::KEY_CURRENCY] ?? null;
            $type = static::LOCALE_TO_PRICE_TYPE_MAP[$locale][self::KEY_PRICE_TYPE] ?? null;

            foreach ($priceInfo[static::KEY_DATA] as $price) {
                if ($price[static::KEY_CURRENCY] === $currency) {
                    $result[] = [
                        static::KEY_PRICE => (int)((float)$price[static::KEY_AMOUNT]) * 100,
                        static::KEY_PRICE_TYPE => $type,
                    ];
                }
            }
        }

        return $result;
    }
}
