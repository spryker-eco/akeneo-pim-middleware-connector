<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddAbstractSkuIfNotExist extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_PARENT = 'parent';
    protected const KEY_CODE = 'code';
    protected const KEY_IDENTIFIER = 'identifier';
    protected const KEY_ABSTRACT_SKU = 'abstract_sku';
    protected const ABSTRACT_IDENTIFIER = 'abstract_product_creation';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if ($payload[static::KEY_PARENT] === null) {
            $value[static::KEY_ABSTRACT_SKU] = $this->createAbstractSKU($payload[static::KEY_IDENTIFIER]);
            $value[static::ABSTRACT_IDENTIFIER] = true;

            return $value;
        }

        $value = [];
        $value[static::KEY_ABSTRACT_SKU] = $payload[static::KEY_PARENT];
        $value[static::ABSTRACT_IDENTIFIER] = false;

         return $value;
    }

    /**
     * @param string $sku
     *
     * @return string
     */
    protected function createAbstractSKU(string $sku): string
    {
        return $sku . '_abstract';
    }
}
