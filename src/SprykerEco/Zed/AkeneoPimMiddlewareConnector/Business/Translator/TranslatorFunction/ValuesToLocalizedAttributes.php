<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class ValuesToLocalizedAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_LOCALIZED_ATTRIBUTES = 'localizedAttributes';

    const KEY_LOCALE = 'locale';
    const KEY_DATA = 'data';

    const KEY_TITLE = 'title';
    const KEY_NAME = 'name';
    const KEY_DESCRIPTION = 'description';

    /**
     * @var array
     */
    protected $requiredOptions = ['locales'];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return array
     */
    public function translate($value, array $payload): array
    {
        $localizedAttributes = [];

        foreach ($value as $key => $scopedAttributes) {
            foreach ($scopedAttributes as $attribute) {
                if ($this->isLocalizableByAkeneo($attribute)) {
                    $localizedAttributes = $this->addToLocalizedAttributes(
                        $key,
                        $attribute[static::KEY_DATA],
                        $attribute[static::KEY_LOCALE],
                        $localizedAttributes
                    );
                }

                if ($this->hasLocaleKeysInData($attribute)) {
                    foreach ($attribute[static::KEY_DATA] as $locale => $localizedValue) {
                        $localizedAttributes = $this->addToLocalizedAttributes(
                            $key,
                            $localizedValue,
                            $locale,
                            $localizedAttributes
                        );
                    }
                }
            }
        }

        $value[static::KEY_LOCALIZED_ATTRIBUTES] = $localizedAttributes;

        return $value;
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
     * @param string $key
     * @param mixed $value
     * @param string $locale
     * @param array $localizedAttributes
     *
     * @return array
     */
    protected function addToLocalizedAttributes(string $key, $value, string $locale, array $localizedAttributes): array
    {
        if (!array_key_exists($locale, $localizedAttributes)) {
            $localizedAttributes[$locale] = [];
        }
        if ($key === static::KEY_TITLE) {
            $localizedAttributes[$locale][static::KEY_NAME] = $value;
            return $localizedAttributes;
        }
        $localizedAttributes[$locale][$key] = $value;

        return $localizedAttributes;
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->options['locales'];
    }
}
