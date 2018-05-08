<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductImportMap extends AbstractMap
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'concrete_sku' => 'identifier',
            'abstract_sku' => 'parent',
            'prices' => 'values.price',
            'images' => 'values.bild_information',
            'picto_images' => 'values.picto_informationen',
            'is_active' => 'enabled',
            'attributes' => [
                'values.attributes',
            ],
            'localizedAttributes' => [
                'values.localizedAttributes',
            ],
            'relations.others' => 'associations.PACK.product_models',
            'relations.x_sell' => 'associations.X_SELL.product_models',
            'relations.addon' => 'associations.SUBSTITUTION.product_models',
            'is_searchable' => function () {
                return true;
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
