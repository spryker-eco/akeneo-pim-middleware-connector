<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration;

use SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ConfigurationProfilePluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 */
class AkeneoPimConfigurationProfilePlugin implements ConfigurationProfilePluginInterface
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getProcessConfigurationPlugins(): array
    {
        return $this->getFactory()
            ->getAkeneoPimProcesses();
    }
}
