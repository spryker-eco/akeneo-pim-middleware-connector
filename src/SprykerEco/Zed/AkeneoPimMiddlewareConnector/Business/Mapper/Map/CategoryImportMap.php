<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class CategoryImportMap extends AbstractMap
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
            'is_root' => function (array $item) {
                return empty($item['parent']);
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
