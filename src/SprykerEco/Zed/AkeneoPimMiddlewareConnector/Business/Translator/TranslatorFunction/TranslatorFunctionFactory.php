<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface;

class TranslatorFunctionFactory
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface
     */
    private $akeneoPimService;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createAddAttributeOptionsTranslatorFunction()
    {
        return new AddAttributeOptions($this->akeneoPimService);
    }
}
