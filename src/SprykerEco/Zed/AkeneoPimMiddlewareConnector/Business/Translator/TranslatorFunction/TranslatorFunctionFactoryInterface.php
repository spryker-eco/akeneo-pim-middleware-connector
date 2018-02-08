<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

interface TranslatorFunctionFactoryInterface
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createAddAttributeOptionsTranslatorFunction();
}
