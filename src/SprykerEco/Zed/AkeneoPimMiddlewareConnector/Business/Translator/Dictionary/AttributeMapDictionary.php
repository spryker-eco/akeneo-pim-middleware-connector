<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class AttributeMapDictionary extends AbstractDictionary
{
    /**
     * @var array
     */
    protected static $localeMap;

    /**
     * @var array
     */
    protected static $superAttributeMap;

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
            'is_super' => [
                [
                    'MarkAsSuperAttribute',
                    'options' => [
                        'map' => $this->getSuperAttributeMap(),
                    ],
                ],
            ],
            'options' => [
                [
                    'AddAttributeOptions',
                    'options' => [
                        'pageSize' => 100,
                    ],
                ],
            ],
            'labels' => [
                [
                    'LabelsToLocalizedAttributeNames',
                    'options' => [
                        'key' => 'key_translation',
                    ],
                ],
                'AddAttributeValues',
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
                    ],
                ],
            ],
            'labels.*.key_translation' => [
                'AttributeEmptyTranslationToKey',
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
    protected function getSuperAttributeMap(): array
    {
        if (static::$superAttributeMap === null) {
            $content = file_get_contents($this->config->getSuperAttributeMapFilePath());
            static::$superAttributeMap = json_decode($content, true);
        }

        return static::$superAttributeMap;
    }
}
