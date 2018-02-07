<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorDependencyProvider;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\TranslatorFunctionFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 */
class AkeneoPimMiddlewareConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\TranslatorFunctionFactoryInterface
     */
    public function createTranslatorFunctionFactory()
    {
        return new TranslatorFunctionFactory($this->getAkeneoPimService());
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface
     */
    protected function getAkeneoPimService(): AkeneoPimMiddlewareConnectorToAkeneoPimInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SERVICE_AKENEO_PIM);
    }
}
