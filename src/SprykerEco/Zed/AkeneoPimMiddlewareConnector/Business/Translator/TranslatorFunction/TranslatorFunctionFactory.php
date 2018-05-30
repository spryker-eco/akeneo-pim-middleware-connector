<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategy;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class TranslatorFunctionFactory implements TranslatorFunctionFactoryInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    protected $akeneoPimService;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface
     */
    protected $urlGenerator;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     */
    public function  __construct(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
        $this->urlGenerator = $this->createUrlGeneratorStrategy();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createAddAttributeOptionsTranslatorFunction(): TranslatorFunctionInterface
    {
        return new AddAttributeOptions($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface
     */
    public function createAddUrlToLocalizedAttributesTranslatorFunction(): TranslatorFunctionInterface
    {
        return new AddUrlToLocalizedAttributes($this->urlGenerator);
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

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface
     */
    public function createUrlGeneratorStrategy(): UrlGeneratorStrategyInterface
    {
        return new UrlGeneratorStrategy();
    }
}
