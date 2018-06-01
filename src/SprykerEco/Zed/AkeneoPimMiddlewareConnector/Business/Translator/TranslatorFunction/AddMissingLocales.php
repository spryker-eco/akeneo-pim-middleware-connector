<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddMissingLocales extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const OPTION_LOCALES = 'locales';
    protected const KEY_LOCALIZED_ATTRIBUTES = 'localizedAttributes';

    /**
     * @var array
     */
    protected $requiredOptions = [
        self::OPTION_LOCALES,
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        foreach ($this->getLocales() as $locale) {
            if (!array_key_exists($locale, $value)) {
                $value[$locale] = [];
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->options[static::OPTION_LOCALES];
    }
}
