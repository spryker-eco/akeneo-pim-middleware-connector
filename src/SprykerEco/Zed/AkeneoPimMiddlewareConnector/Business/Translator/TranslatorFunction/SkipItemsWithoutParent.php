<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingParentForProductException;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;

class SkipItemsWithoutParent extends AbstractTranslatorFunction
{
    /**
     * @param mixed $value
     * @param array $payload
     *
     * @throws \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Exception\MissingParentForProductException
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if (empty($value)) {
            throw new MissingParentForProductException();
        }
        return $value;
    }
}
