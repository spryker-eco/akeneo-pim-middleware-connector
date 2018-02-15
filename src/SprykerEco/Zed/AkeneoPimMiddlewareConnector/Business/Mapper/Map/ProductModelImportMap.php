<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

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
                return $this->config->getDefaultTaxSet();
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
            'color_code' => function ($item) {
                return '';
            },
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
