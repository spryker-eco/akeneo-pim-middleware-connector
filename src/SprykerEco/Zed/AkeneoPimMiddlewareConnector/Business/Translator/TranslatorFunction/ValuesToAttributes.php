<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class ValuesToAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_ATTRIBUTES = 'attributes';

    const KEY_LOCALE = 'locale';
    const KEY_DATA = 'data';

    /**
     * @var array
     */
    protected $requiredOptions = ['locales'];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload): array
    {
        $value[static::KEY_ATTRIBUTES] = [];

        foreach ($value as $key => $scopedAttributes) {
            foreach ($scopedAttributes as $attribute) {
                if (!$this->isLocalizedAttribute($attribute)) {
                    $value[static::KEY_ATTRIBUTES][$key] = $attribute[static::KEY_DATA];
                }
            }
        }

        return $value;
    }

    /**
     * @param mixed $attribute
     *
     * @return bool
     */
    protected function isLocalizedAttribute($attribute): bool
    {
        return $this->isLocalizableByAkeneo($attribute) || $this->hasLocaleKeysInData($attribute);
    }

    /**
     * @param mixed $attribute
     *
     * @return bool
     */
    protected function isLocalizableByAkeneo($attribute): bool
    {
        return is_array($attribute) && array_key_exists(static::KEY_LOCALE, $attribute) && $attribute[static::KEY_LOCALE] !== null;
    }

    /**
     * @param mixed $attribute
     *
     * @return bool
     */
    protected function hasLocaleKeysInData($attribute): bool
    {
        return is_array($attribute) && is_array($attribute[static::KEY_DATA] ?? null) && $this->hasLocaleKey(array_keys($attribute[static::KEY_DATA]));
    }

    /**
     * @param mixed $keys
     *
     * @return bool
     */
    protected function hasLocaleKey($keys): bool
    {
        foreach ($this->getLocales() as $locale) {
            if (in_array($locale, $keys, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    protected function getLocales()
    {
        return $this->options['locales'];
    }
}
