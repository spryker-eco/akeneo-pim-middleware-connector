<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\Tax\Persistence\Map\SpyTaxSetTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

class AkeneoPimMiddlewareConnectorQueryContainer extends AbstractQueryContainer implements AkeneoPimMiddlewareConnectorQueryContainerInterface
{
    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyTaxSetQuery()
    {
        return SpyTaxSetQuery::create()
            ->select([
                SpyTaxSetTableMap::COL_ID_TAX_SET,
                SpyTaxSetTableMap::COL_NAME,
            ]);
    }

    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyLocaleQuery()
    {
        return SpyLocaleQuery::create()
            ->select([
                SpyLocaleTableMap::COL_ID_LOCALE,
                SpyLocaleTableMap::COL_LOCALE_NAME,
            ]);
    }
}
