<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxSetTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorPersistenceFactory getFactory()
 */
class AkeneoPimMiddlewareConnectorQueryContainer extends AbstractQueryContainer implements AkeneoPimMiddlewareConnectorQueryContainerInterface
{
    /**
     * @api
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function querySelectSpyTaxSet(): ModelCriteria
    {
        return $this->getFactory()
            ->createSpyTaxSetQuery()
            ->select([
                SpyTaxSetTableMap::COL_ID_TAX_SET,
                SpyTaxSetTableMap::COL_NAME,
            ]);
    }

    /**
     * @api
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function querySelectLocale(): ModelCriteria
    {
        return $this->getFactory()
            ->createSpyLocaleQuery()
            ->select([
                SpyLocaleTableMap::COL_ID_LOCALE,
                SpyLocaleTableMap::COL_LOCALE_NAME,
            ]);
    }
}
