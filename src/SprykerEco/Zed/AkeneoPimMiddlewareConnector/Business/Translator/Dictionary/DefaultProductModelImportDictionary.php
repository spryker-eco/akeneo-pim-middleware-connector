<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class DefaultProductModelImportDictionary extends AbstractDictionary
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
            'categories' => [
                [
                    'ArrayToString',
                    'options' => [
                        'glue' => ',',
                    ],
                ],
            ],
            'values.*' => 'MeasureUnitToInt',
            'values.collection.data' => function ($value) {
                if (is_array($value)) {
                    return reset($value);
                }

                return $value;
            },
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
                    'DefaultValuesToLocalizedAttributes',
                    'options' => [
                        'locales' => $this->config->getLocalesForImport(),
                    ],
                ],
            ],
            'values.localizedAttributes' => [
                [
                    'AddMissingLocales',
                    'options' => [
                        'locales' => $this->config->getLocalesForImport(),
                    ],
                ],
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
            'values.localizedAttributes.*' => [
                [
                    'AddMissingAttributes',
                    'options' => [
                        'attributes' => [
                            'name' => '',
                            'description' => '',
                            'meta_title' => '',
                            'meta_description' => '',
                            'meta_keywords' => '',
                        ],
                    ],
                ],
                [
                    'AddUrlToLocalizedAttributes',
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
