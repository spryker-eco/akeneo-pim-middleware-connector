<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

interface AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface
{
    /**
     * @param string $sku
     *
     * @return int|null
     */
    public function findProductAbstractIdBySku(string $sku): ?int;
}
