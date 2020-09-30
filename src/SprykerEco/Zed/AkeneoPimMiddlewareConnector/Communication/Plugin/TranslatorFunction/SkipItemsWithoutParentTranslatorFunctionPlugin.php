<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\SkipItemsWithoutParent;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractGenericTranslatorFunctionPlugin;

class SkipItemsWithoutParentTranslatorFunctionPlugin extends AbstractGenericTranslatorFunctionPlugin
{
    protected const NAME = 'SkipItemsWithoutParent';

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getTranslatorFunctionClassName(): string
    {
        return SkipItemsWithoutParent::class;
    }
}
