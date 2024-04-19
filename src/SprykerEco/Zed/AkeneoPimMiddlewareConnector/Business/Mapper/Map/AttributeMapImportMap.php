<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class AttributeMapImportMap extends AbstractMap
{
    protected const ATTRIBUTE_MAP = [
        'pim_catalog_boolean' => 'number',
        'pim_catalog_textarea' => 'textarea',
        'pim_catalog_text' => 'text',
        'pim_catalog_simpleselect' => 'select',
        'pim_reference_data_multiselect' => 'text',
        'pim_catalog_price_collection' => 'text',
        'pim_catalog_number' => 'number',
        'pim_catalog_multiselect' => 'text',
        'pim_catalog_metric' => 'text',
        'pim_catalog_image' => 'text',
        'pim_catalog_identifier' => 'text',
        'pim_catalog_file' => 'text',
        'pim_catalog_date' => 'date',
        'pim_assets_collection' => 'text',
    ];

    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'attribute_key' => 'code',
            'key' => 'code',
            'allow_input' => function () {
                return false;
            },
            'is_multiple' => function () {
                return false;
            },
            'input_type' => function ($value) {
                return static::ATTRIBUTE_MAP[$value['type']];
            },
            'type' => 'type',
            'group' => 'group',
            'options' => 'options',
            'is_super' => 'is_super',
            'localizedAttributes' => 'labels',
            'localizable' => 'localizable',
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
