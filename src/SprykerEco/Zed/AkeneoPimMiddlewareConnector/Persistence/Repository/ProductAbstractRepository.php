<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\Repository;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorPersistenceFactory getFactory()
 */
class ProductAbstractRepository extends AbstractRepository implements ProductAbstractRepositoryInterface
{
    /**
     * @return string
     */
    public function getSkuValues(): string
    {
        $data = $this->getFactory()
           ->createSpyProductAbstractQuery()
           ->select('sku')
           ->distinct()
           ->find()
           ->toArray();

        return json_encode($data);
    }
}
