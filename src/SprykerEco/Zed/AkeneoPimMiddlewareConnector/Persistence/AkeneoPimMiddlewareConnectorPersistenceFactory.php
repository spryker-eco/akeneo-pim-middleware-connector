<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\Tax\Persistence\Base\SpyTaxSetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 */
class AkeneoPimMiddlewareConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Tax\Persistence\Base\SpyTaxSetQuery
     */
    public function createSpyTaxSetQuery(): SpyTaxSetQuery
    {
        return SpyTaxSetQuery::create();
    }

    /**
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery
     */
    public function createSpyLocaleQuery(): SpyLocaleQuery
    {
        return SpyLocaleQuery::create();
    }
}
