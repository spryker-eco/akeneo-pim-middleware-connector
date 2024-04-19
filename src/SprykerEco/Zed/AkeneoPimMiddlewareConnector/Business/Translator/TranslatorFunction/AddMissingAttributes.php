<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddMissingAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_ATTRIBUTES = 'attributes';

    /**
     * @var array
     */
    protected $requiredOptions = [
        self::KEY_ATTRIBUTES,
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $attributes = $this->getAttributes();
        foreach ($attributes as $key => $attributeValue) {
            if (!isset($value[$key])) {
                $value[$key] = $attributeValue;
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function getAttributes(): array
    {
        return $this->options[static::KEY_ATTRIBUTES];
    }
}
