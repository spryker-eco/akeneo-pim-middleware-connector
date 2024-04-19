<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\ValuesToLocalizedAttributes;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractGenericTranslatorFunctionPlugin;

class ValuesToLocalizedAttributesTranslatorFunctionPlugin extends AbstractGenericTranslatorFunctionPlugin
{
    protected const NAME = 'ValuesToLocalizedAttributes';

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
        return ValuesToLocalizedAttributes::class;
    }
}
