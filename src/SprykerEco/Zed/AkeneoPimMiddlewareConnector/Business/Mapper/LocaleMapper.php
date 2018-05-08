<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper;

use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;

class LocaleMapper implements LocaleMapperInterface
{
    /**
     * @param array $payload
     *
     * @return array
     */
    public function map(array $payload): array
    {
        return [
            $payload[SpyLocaleTableMap::COL_LOCALE_NAME] => $payload[SpyLocaleTableMap::COL_ID_LOCALE],
        ];
    }
}
