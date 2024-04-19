<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class LabelsToLocaleIds extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    /**
     * @var array
     */
    protected $requiredOptions = [
        'map',
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if ($value === null) {
            return $value;
        }

        if (empty($value)) {
            $value = $this->getMap();
        }

        $result = [];
        $localeMap = $this->getMap();

        foreach ($value as $locale => $content) {
            if (array_key_exists($locale, $localeMap)) {
                $result[$locale] = $localeMap[$locale];
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return $this->options['map'];
    }
}
