<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
