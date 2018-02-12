<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class ProductModelImportDictionary extends AbstractDictionary
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
                    'UnderScoreHiddenAttributes',
                    'options' => [
                        'map' => $this->getAttributeMap(),
                    ],
                ],
                'ValuesToAttributes',
                'ValuesToLocalizedAttributes',
                'CountryAvailabilityToIsActivePerLocale',
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
                            'title',
                            'product_description',
                            'meta_keywords',
                            'meta_title',
                            'meta_description',
                            'tax_set',
                            'is_active_per_locale',
                            'bild_information',
                            'picto_informationen',
                        ],
                    ],
                ],
            ],
            'values.bild_information' => [
                'ImageDataToImageList',
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
                    ],
                ],
            ],
            'values.picto_informationen' => [
                'ImageDataToImageList',
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
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
