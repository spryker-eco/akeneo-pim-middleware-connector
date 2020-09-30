<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
