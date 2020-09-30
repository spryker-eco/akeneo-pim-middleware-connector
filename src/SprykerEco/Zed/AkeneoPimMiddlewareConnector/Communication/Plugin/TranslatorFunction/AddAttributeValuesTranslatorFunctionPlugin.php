<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\AddAttributeValues;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractGenericTranslatorFunctionPlugin;

class AddAttributeValuesTranslatorFunctionPlugin extends AbstractGenericTranslatorFunctionPlugin
{
    protected const NAME = 'AddAttributeValues';

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
        return AddAttributeValues::class;
    }
}
