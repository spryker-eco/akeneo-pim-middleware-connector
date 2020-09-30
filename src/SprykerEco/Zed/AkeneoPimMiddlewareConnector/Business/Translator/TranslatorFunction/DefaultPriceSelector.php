<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class DefaultPriceSelector extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const DEFAULT_PRICE_TYPE = 'DEFAULT';

    protected const KEY_AMOUNT = 'amount';
    protected const KEY_DATA = 'data';
    protected const KEY_LOCALE = 'locale';
    protected const KEY_CURRENCY = 'currency';
    protected const KEY_PRICE = 'price';
    protected const KEY_PRICE_TYPE = 'type';
    protected const KEY_STORE = 'store';

    public const OPTION_STORES = 'OPTION_STORES';
    public const OPTION_LOCALE_TO_PRICE_MAP = 'LOCALE_TO_PRICE_MAP_OPTION';

    /**
     * @var array
     */
    protected $requiredOptions = [
        self::OPTION_STORES,
        self::OPTION_LOCALE_TO_PRICE_MAP,
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

            $localeToPriceTypeMap = $this->getLocaleToPriceMap();

            if (!array_key_exists($locale, $localeToPriceTypeMap)) {
                continue;
            }

            $currency = $localeToPriceTypeMap[$locale][static::KEY_CURRENCY] ?? null;
            $type = $localeToPriceTypeMap[$locale][static::KEY_PRICE_TYPE] ?? null;
            $store = $localeToPriceTypeMap[$locale][static::KEY_STORE] ?? null;

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
        return $this->options[static::OPTION_STORES];
    }

    /**
     * @return array
     */
    protected function getLocaleToPriceMap(): array
    {
        return $this->options[static::OPTION_LOCALE_TO_PRICE_MAP];
    }
}
