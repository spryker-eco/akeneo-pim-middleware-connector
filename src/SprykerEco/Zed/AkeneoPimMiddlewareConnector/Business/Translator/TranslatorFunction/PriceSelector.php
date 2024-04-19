<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingPriceException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class PriceSelector extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_LOCALE = 'locale';
    protected const KEY_DATA = 'data';
    protected const KEY_AMOUNT = 'amount';

    protected const KEY_PRICE = 'price';
    protected const KEY_CURRENCY = 'currency';
    protected const KEY_PRICE_TYPE = 'type';
    protected const KEY_STORE = 'store';

    public const OPTION_LOCALE_TO_PRICE_MAP = 'LOCALE_TO_PRICE_MAP_OPTION';

    /**
     * @var array
     */
    protected $requiredOptions = [
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

        $localeToPriceTypeMap = $this->getLocaleToPriceMap();

        foreach ($value as $priceInfo) {
            $locale = $priceInfo[static::KEY_LOCALE];
            if (!array_key_exists($locale, $localeToPriceTypeMap)) {
                continue;
            }

            $currency = $localeToPriceTypeMap[$locale][static::KEY_CURRENCY] ?? null;
            $type = $localeToPriceTypeMap[$locale][self::KEY_PRICE_TYPE] ?? null;
            $store = $localeToPriceTypeMap[$locale][self::KEY_STORE] ?? null;

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
    protected function getLocaleToPriceMap(): array
    {
        return $this->options[static::OPTION_LOCALE_TO_PRICE_MAP];
    }
}
