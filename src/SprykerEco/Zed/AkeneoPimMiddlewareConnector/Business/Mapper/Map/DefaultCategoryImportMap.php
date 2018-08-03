<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class DefaultCategoryImportMap extends AbstractMap
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'category_key' => 'code',
            'parent_category_key' => 'parent',
            'localizedAttributes' => 'labels',
            'locales' => 'labels',
            'is_active' => 'enabled',
            'is_root' => function (array $item) {
                return false;
            },
            'is_main' => function (array $item) {
                return true;
            },
            'fk_category_template' => function (array $item) {
                return null;
            },
        ];
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return MapInterface::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
