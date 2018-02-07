<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimBridge;

class AkeneoPimMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    const SERVICE_AKENEO_PIM = 'SERVICE_AKENEO_PIM';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[self::SERVICE_AKENEO_PIM] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToAkeneoPimBridge($container->getLocator()->akeneoPim()->service());
        };
    }
}
