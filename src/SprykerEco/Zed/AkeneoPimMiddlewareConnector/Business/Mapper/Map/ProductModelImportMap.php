<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class ProductModelImportMap extends AbstractMap
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'abstract_sku' => 'code',
            'category_key' => 'categories',
            'is_active' => 'enabled',
            'images' => 'values.bild_information',

            'attributes' => [
                'values.attributes',
                'except' => [
                    'country_availability',
                ],
            ],
            'localizedAttributes' => [
                'values.localizedAttributes',
                'except' => [
                    'bild_information',
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return ProcessConfig::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
