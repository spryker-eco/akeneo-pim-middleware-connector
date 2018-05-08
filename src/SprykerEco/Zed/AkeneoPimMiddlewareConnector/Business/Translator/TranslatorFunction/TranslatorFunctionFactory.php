<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class TranslatorFunctionFactory implements TranslatorFunctionFactoryInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    protected $akeneoPimService;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createAddAttributeOptionsTranslatorFunction(): TranslatorFunctionInterface
    {
        return new AddAttributeOptions($this->akeneoPimService);
    }

    /**
     * @param string $translatorFunctionClassName
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createTranslatorFunction(string $translatorFunctionClassName): TranslatorFunctionInterface
    {
        return new $translatorFunctionClassName();
    }
}
