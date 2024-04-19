<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class ProductModelImportMap extends AbstractMap
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
                return $this->config->getTaxSet();
            },
            'new_from' => function ($item) {
                return null;
            },
            'new_to' => function ($item) {
                return null;
            },
            'category_product_order' => function ($item) {
                return 0;
            },
            'abstract_sku' => 'code',
            'category_key' => 'categories',
            'is_active' => 'enabled',

            'attributes' => [
                'values.attributes',
            ],
            'localizedAttributes' => [
                'values.localizedAttributes',
            ],
            'color_code' => function ($item) {
                return '';
            },
            'stores' => function ($item) {
                return $this->config->getActiveStoresForProducts();
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
