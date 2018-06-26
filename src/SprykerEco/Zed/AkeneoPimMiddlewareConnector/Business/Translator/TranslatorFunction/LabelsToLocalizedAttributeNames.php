<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class LabelsToLocalizedAttributeNames extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_NAME = 'name';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $defaultLocales = $this->getLocales();

        $key = isset($this->options['key']) ? $this->options['key'] : static::KEY_NAME;

        if (empty($value) && $defaultLocales) {
           $code = $payload['category_key'];
           foreach ($defaultLocales as $locale) {
               $value[$locale] = [
                   $key => $code,
               ];
           }

           return $value;
        }

        return array_map(function ($value) use ($key) {
            return [
                $key => $value,
            ];
        }, $value);
    }

    /**
     * @return array
     */
    protected function getLocales(): array
    {
        return $this->options['defaultLocales'];
    }
}
