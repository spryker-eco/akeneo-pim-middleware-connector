<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class MeasureUnitToInt extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_DATA = 'data';
    protected const KEY_AMOUNT = 'amount';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if (is_array($value[0][static::KEY_DATA]) && array_key_exists(static::KEY_AMOUNT, $value[0][static::KEY_DATA])) {
            $value[0][static::KEY_DATA] = (int)$value[0][static::KEY_DATA][static::KEY_AMOUNT];
        }

        return $value;
    }
}
