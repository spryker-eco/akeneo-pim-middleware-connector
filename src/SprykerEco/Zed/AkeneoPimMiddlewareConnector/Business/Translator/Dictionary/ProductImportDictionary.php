<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\PriceSelector;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class ProductImportDictionary extends AbstractDictionary
{
    /**
     * @var array
     */
    protected static $localeMap;

    /**
     * @var array
     */
    protected static $attributeMap;

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
    public function getDictionary(): array
    {
        return [
            'values.*' => 'MeasureUnitToInt',
            'values' => [
                [
                    'EnrichAttributes',
                    'options' => [
                        'map' => $this->getAttributeMap(),
                        'excludeKeys' => [
                            'country_availability',
                        ],
                    ],
                ],
                [
                    'ValuesToAttributes',
                    'options' => [
                        'locales' => $this->config->getLocalesForImport(),
                    ],
                ],
                [
                    'ValuesToLocalizedAttributes',
                    'options' => [
                        'locales' => $this->config->getLocalesForImport(),
                    ],
                ],
            ],
            'values.price' => [
                [
                    'PriceSelector',
                    'options' => [
                        PriceSelector::OPTION_LOCALE_TO_PRICE_MAP => $this->config->getLocaleToPriceMap(),
                    ],
                ],
            ],
            'values.localizedAttributes' => [
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
                    ],
                ],
                [
                    'MoveLocalizedAttributesToAttributes',
                    'options' => [
                        'blacklist' => [
                            'name',
                            'title',
                            'product_description',
                            'tax_set',
                            'is_active_per_locale',
                            'price',
                            'bild_information',
                            'picto_informationen',
                            'meta_title',
                            'meta_description',
                            'meta_keywords',
                        ],
                    ],
                ],
            ],
            'values.localizedAttributes.*' => [
                [
                    'ExcludeKeysAssociativeFilter',
                    'options' => [
                        'excludeKeys' => [
                            'price',
                            'bild_information',
                            'picto_information',
                            'tax_set',
                        ],
                    ],
                ],
                [
                    'AddMissingAttributes',
                    'options' => [
                        'attributes' => [
                            'name' => '',
                            'description' => '',
                            'meta_title' => '',
                            'meta_description' => '',
                            'meta_keywords' => '',
                            'is_searchable' => true,
                        ],
                    ],
                ],
            ],
            'values.attributes' => [
                [
                    'ExcludeKeysAssociativeFilter',
                    'options' => [
                        'excludeKeys' => [
                            'price',
                            'country_availability',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getLocaleMap(): array
    {
        if (static::$localeMap === null) {
            $content = file_get_contents($this->config->getLocaleMapFilePath());
            static::$localeMap = json_decode($content, true);
        }

        return static::$localeMap;
    }

    /**
     * @return array
     */
    protected function getAttributeMap(): array
    {
        if (static::$attributeMap === null) {
            $content = file_get_contents($this->config->getAttributeMapFilePath());
            static::$attributeMap = json_decode($content, true);
        }

        return static::$attributeMap;
    }
}
