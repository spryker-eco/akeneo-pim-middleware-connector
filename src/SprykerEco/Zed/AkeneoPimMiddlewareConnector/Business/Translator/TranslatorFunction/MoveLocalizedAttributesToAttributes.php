<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class MoveLocalizedAttributesToAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_ATTRIBUTES = 'attributes';
    const ATTRIBUTE_BLACKLIST = 'blacklist';

    /**
     * @var array
     */
    protected $requiredOptions = [
        self::ATTRIBUTE_BLACKLIST,
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return array
     */
    public function translate($value, array $payload): array
    {

        foreach ($value as $localeId => $scopedAttributes) {
            if (!isset($value[$localeId][static::KEY_ATTRIBUTES])) {
                $value[$localeId][static::KEY_ATTRIBUTES] = [];
            }
            foreach ($scopedAttributes as $attributeKey => $attribute) {
                if (in_array($attributeKey, $this->options[static::ATTRIBUTE_BLACKLIST])) {
                    continue;
                }

                $value[$localeId][static::KEY_ATTRIBUTES][$attributeKey] = $attribute;
                unset($value[$localeId][$attributeKey]);
            }
        }

        return $value;
    }
}
