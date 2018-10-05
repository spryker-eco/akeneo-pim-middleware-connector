<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class DefaultCategoryImportDictionary extends AbstractDictionary
{
    /**
     * @var array
     */
    protected static $localeMap;

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
            'localizedAttributes' => [
                [
                    'LabelsToLocalizedAttributeNames',
                    'options' => [
                        'defaultLocales' => $this->config->getLocalesForImport(),
                    ],
                ],
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
                    ],
                ],
            ],
            'locales' => [
                [
                    'LabelsToLocaleIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
                    ],
                ],
            ],
            'fk_category_template' => function ($value, $payload) {
                return $this->config->getFkCategoryTemplate();
            },
            'parent_category_key' => function ($value) {
                if (empty($value)) {
                    return 'demoshop';
                }
                return $value;
            },
        ];
    }

    /**
     * @return array
     */
    protected function getLocaleMap(): array
    {
        if (static::$localeMap === null) {
            $content = file_get_contents($this->config->getLocaleMapFilePath());

            static::$localeMap = array_intersect_key(json_decode($content, true), array_flip($this->config->getLocalesForImport()));
        }

        return static::$localeMap;
    }
}
