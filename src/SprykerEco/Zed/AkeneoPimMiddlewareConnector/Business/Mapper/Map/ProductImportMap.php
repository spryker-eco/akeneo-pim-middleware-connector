<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductImportMap extends AbstractMap
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig
     */
    private $config;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig $config
     */
    public function __construct(AkeneoPimMiddlewareConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'taxSetName' => function ($item) {
                return $this->config->getDefaultTaxSet();
            },
            'color_code' => function ($item) {
                return '';
            },
            'new_from' => function ($item) {
                return null;
            },
            'new_to' => function ($item) {
                return null;
            },
            'category_key' => 'categories',
            'category_product_order' => function ($item) {
                return 0;
            },
            'stores' => function ($item) {
                return $this->config->getDefaultStoresForProducts();
            },
            'concrete_sku' => 'identifier',
            'abstract_sku' => 'parent',
            'prices' => function ($item) {
                $result = [];
                foreach ($item['values']['price'] as $value) {
                    $result[] = [
                        'price' => $value['price'],
                        'price_type' => $value['type'],
                        'currency' => $value['currency'],
                        'store' => $value['store'],
                        'concrete_sku' => $item['identifier'],
                        'value_gross' => $value['price'],
                        'value_net' => $value['price'],
                    ];
                }
                return $result;
            },
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
