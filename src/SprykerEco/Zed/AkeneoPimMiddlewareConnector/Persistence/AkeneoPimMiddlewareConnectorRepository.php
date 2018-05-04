<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorDependencyProvider;

class AkeneoPimMiddlewareConnectorRepository extends AbstractRepository implements AkeneoPimMiddlewareConnectorRepositoryInterface
{
    /**
     * @return array
     */
    public function getSkuList(): array
    {
        $data = $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_ABSTRACT_QUERY)
           ->select('sku')
           ->distinct()
           ->find()
           ->toArray();

        return $data;
    }
}
