<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddFamilyAttribute extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_FAMILY = 'family';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        array_key_exists(static::KEY_FAMILY, $payload) ? $value[static::KEY_FAMILY] = $payload[static::KEY_FAMILY] : null;

        return $value;
    }
}
