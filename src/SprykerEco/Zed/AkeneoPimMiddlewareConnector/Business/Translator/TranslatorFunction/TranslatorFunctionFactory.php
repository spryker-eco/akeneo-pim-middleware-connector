<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

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
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface $urlGenerator
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService, UrlGeneratorStrategyInterface $urlGenerator)
    {
        $this->akeneoPimService = $akeneoPimService;
        $this->urlGenerator = $urlGenerator;
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
}
