<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper;

use Orm\Zed\Tax\Persistence\Map\SpyTaxSetTableMap;

class TaxSetMapper implements TaxSetMapperInterface
{
    /**
     * @param array $payload
     *
     * @return array
     */
    public function map(array $payload): array
    {
        return [
            $payload[SpyTaxSetTableMap::COL_NAME] => $payload[SpyTaxSetTableMap::COL_ID_TAX_SET],
        ];
    }
}
