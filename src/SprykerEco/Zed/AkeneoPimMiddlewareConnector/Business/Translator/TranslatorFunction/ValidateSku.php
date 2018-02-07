<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\InvalidSkuException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class ValidateSku extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    /**
     * @var array
     */
    protected $requiredOptions = [
        'pattern_blacklist',
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @throws \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\InvalidSkuException
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        foreach ($this->getPaternBlacklist() as $pattern) {
            if (preg_match('/' . $pattern . '/', $value)) {
                throw new InvalidSkuException(sprintf('SKU invalid: %s', $value));
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function getPaternBlacklist(): array
    {
        return $this->options['pattern_blacklist'];
    }
}
