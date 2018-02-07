<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

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
            'attributes' => [
                'values.attributes',
//                'except' => [
//                    'variation_parent_product',
//                ],
            ],
            'localizedAttributes' => [
                'values.localizedAttributes',
//                'itemExcept' => [
//                    'price',
//                    'bild_information',
//                ],
            ],
            'relations.others' => 'associations.PACK.product_models',
            'relations.x_sell' => 'associations.X_SELL.product_models',
            'relations.addon' => 'associations.SUBSTITUTION.product_models',
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
