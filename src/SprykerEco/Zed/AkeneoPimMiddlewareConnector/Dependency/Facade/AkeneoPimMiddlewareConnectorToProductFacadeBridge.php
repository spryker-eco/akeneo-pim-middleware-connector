<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

class AkeneoPimMiddlewareConnectorToProductFacadeBridge implements AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface
{
    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @param \Spryker\Zed\Product\Business\ProductFacadeInterface $productFacade
     */
    public function __construct($productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @param string $sku
     *
     * @return int|null
     */
    public function findProductAbstractIdBySku(string $sku): ?int
    {
        return $this->productFacade->findProductAbstractIdBySku($sku);
    }
}
