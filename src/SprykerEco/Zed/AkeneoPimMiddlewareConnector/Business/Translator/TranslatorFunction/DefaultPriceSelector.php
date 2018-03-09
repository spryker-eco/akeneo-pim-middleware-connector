<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class DefaultPriceSelector extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const DEFAULT_PRICE_TYPE = 'DEFAULT';

    const KEY_AMOUNT = 'amount';
    const KEY_DATA = 'data';
    const KEY_LOCALE = 'locale';

    const KEY_STORES = 'stores';
    const KEY_CURRENCY = 'currency';
    const KEY_PRICE = 'price';
    const KEY_PRICE_TYPE = 'type';

    const KEY_STORE = 'store';

    const LOCALE_TO_PRICE_TYPE_MAP = [
        'de_DE' => [
            self::KEY_CURRENCY => 'EUR',
            self::KEY_PRICE_TYPE => 'DEFAULT',
            self::KEY_STORE => 'DE',
        ],
        'en_US' => [
            self::KEY_CURRENCY => 'USD',
            self::KEY_PRICE_TYPE => 'DEFAULT',
            self::KEY_STORE => 'US',
        ],
    ];
    /**
     * @var array
     */
    protected $requiredOptions = [
        self::KEY_STORES,
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @throws \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException
     *
     * @return array
     */
    public function translate($value, array $payload): array
    {
        if ($value === null) {
            throw new MissingPriceException();
        }

        $result = [];

        foreach ($value as $priceInfo) {
            $locale = $priceInfo[static::KEY_LOCALE];
            if ($locale == null) {
                foreach ($priceInfo[static::KEY_DATA] as $price) {
                    foreach ($this->getStores() as $store) {
                        $result[] = [
                            static::KEY_PRICE => (int)((float)$price[static::KEY_AMOUNT]) * 100,
                            static::KEY_PRICE_TYPE => static::DEFAULT_PRICE_TYPE,
                            static::KEY_CURRENCY => $price[static::KEY_CURRENCY],
                            static::KEY_STORE => $store,
                        ];
                    }
                }
                return $result;
            }
            if (!array_key_exists($locale, static::LOCALE_TO_PRICE_TYPE_MAP)) {
                continue;
            }

            $currency = static::LOCALE_TO_PRICE_TYPE_MAP[$locale][static::KEY_CURRENCY] ?? null;
            $type = static::LOCALE_TO_PRICE_TYPE_MAP[$locale][self::KEY_PRICE_TYPE] ?? null;
            $store = static::LOCALE_TO_PRICE_TYPE_MAP[$locale][self::KEY_STORE] ?? null;

            foreach ($priceInfo[static::KEY_DATA] as $price) {
                if ($price[static::KEY_CURRENCY] === $currency) {
                    $result[] = [
                        static::KEY_PRICE => (int)((float)$price[static::KEY_AMOUNT]) * 100,
                        static::KEY_PRICE_TYPE => $type,
                        static::KEY_CURRENCY => $price[static::KEY_CURRENCY],
                        static::KEY_STORE => $store,
                    ];
                }
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    protected function getStores(): array
    {
        return $this->options[static::KEY_STORES];
    }
}
