<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

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
            'values.price' => 'PriceSelector',
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

    //@todo repeated method
    /**
     * @return array
     */
    protected function getLocaleMap(): array
    {
        //@todo inject path from configuration
        if (static::$localeMap === null) {
            $content = file_get_contents(APPLICATION_ROOT_DIR . '/data/import/maps/locale_map.json');
            static::$localeMap = json_decode($content, true);
        }

        return static::$localeMap;
    }

    //@todo repeated method
    /**
     * @return array
     */
    protected function getAttributeMap(): array
    {
        //@todo inject path from configuration
        if (static::$attributeMap === null) {
            $content = file_get_contents(APPLICATION_ROOT_DIR . '/data/import/maps/attribute_map.json');
            static::$attributeMap = json_decode($content, true);
        }

        return static::$attributeMap;
    }
}
