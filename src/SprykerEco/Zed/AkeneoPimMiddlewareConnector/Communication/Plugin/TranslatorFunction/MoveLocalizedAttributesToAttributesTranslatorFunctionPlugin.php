<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\MoveLocalizedAttributesToAttributes;
use SprykerMiddleware\Zed\Process\Communication\Plugin\TranslatorFunction\AbstractGenericTranslatorFunctionPlugin;

class MoveLocalizedAttributesToAttributesTranslatorFunctionPlugin extends AbstractGenericTranslatorFunctionPlugin
{
    protected const NAME = 'MoveLocalizedAttributesToAttributes';

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
        return MoveLocalizedAttributesToAttributes::class;
    }
}
