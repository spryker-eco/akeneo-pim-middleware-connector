<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class EnrichAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_OPTIONS = 'options';
    const KEY_DATA = 'data';
    const KEY_LOCALE = 'locale';
    const KEY_TYPE = 'type';
    const KEY_LOCALIZABLE = 'localizable';
    const KEY_KEY = 'key';

    protected const ATTRIBUTE_PRICE = 'price';

    protected const ATTRIBUTE_TYPES_WITH_OPTIONS = [
        'pim_catalog_simpleselect',
        'pim_catalog_multiselect',
    ];

    protected const ATTRIBUTES_TYPES_FOR_SKIPPING = [
        'pim_assets_collection',
        'pim_reference_data_multiselect',
        'pim_reference_data_simpleselect',
        'pim_catalog_price_collection'
    ];

    /**
     * @var array
     */
    protected static $attributeOptionMap;

    /**
     * @var array
     */
    protected static $attributeLocalizableMap;

    /**
     * @var array
     */
    protected static $attributesForSkippingMap;

    /**
     * @var array
     */
    protected $requiredOptions = [
        'map',
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $this->initAttributeOptionMap();

        foreach ($value as $attributeKey => &$attributeValues) {
            if ($this->isKeySkipped($attributeKey)) {
                unset($value[$attributeKey]);
                continue;
            }

            if (!$this->hasKey($attributeKey) || $this->isKeyExcluded($attributeKey)) {
                continue;
            }

            $isAttributeLocalizable = $this->isAttributeLocalizable($attributeKey);

            foreach ($attributeValues as &$attributeValue) {
                $attributeData = $attributeValue[static::KEY_DATA];
                $locale = $attributeValue[static::KEY_LOCALE];

                if ($attributeData === null) {
                    unset($value[$attributeKey]);
                    continue 2;
                }

                if (count($attributeData) === 0) {
                    continue;
                }

                if ($isAttributeLocalizable) {
                    $options = $this->getOptions($attributeKey, $attributeData);
                    $attributeValue[static::KEY_DATA] = $options[$locale];
                    continue;
                }
                
                $value[$attributeKey] = $this->getAttributeValue($attributeKey, $attributeData);
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return $this->options['map'];
    }

    /**
     * @return void
     */
    protected function initAttributeOptionMap(): void
    {
        if (static::$attributeOptionMap !== null) {
            return;
        }

        static::$attributeOptionMap = array_map(
            function ($element) {
                return $element[static::KEY_OPTIONS];
            },
            array_filter($this->getMap(), function ($element) {
                return
                    count($element[static::KEY_OPTIONS] ?? []) > 0 &&
                    in_array($element[static::KEY_TYPE], static::ATTRIBUTE_TYPES_WITH_OPTIONS);
            })
        );

        static::$attributeLocalizableMap = array_map(
            function ($element) {
                return $element[static::KEY_LOCALIZABLE];
            },
            array_filter($this->getMap(), function ($element) {
                return in_array($element[static::KEY_TYPE], static::ATTRIBUTE_TYPES_WITH_OPTIONS);
            })
        );

        static::$attributesForSkippingMap = array_map(
            function ($element) {
                return $element[static::KEY_KEY];
            },
            array_filter($this->getMap(), function ($element) {
                return in_array($element[static::KEY_TYPE], static::ATTRIBUTES_TYPES_FOR_SKIPPING) && $element[static::KEY_KEY] != static::ATTRIBUTE_PRICE;
            })
        );
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function hasKey(string $key): bool
    {
        return array_key_exists($key, static::$attributeOptionMap);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function isKeyExcluded(string $key): bool
    {
        return in_array($key, $this->options['excludeKeys']);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function isKeySkipped(string $key): bool
    {
        return array_key_exists($key, static::$attributesForSkippingMap);
    }

    /**
     * @param string $attributeKey
     * @param string $optionKey
     *
     * @return array
     */
    protected function getOptions(string $attributeKey, string $optionKey): array
    {
        if (!array_key_exists($optionKey, static::$attributeOptionMap[$attributeKey])) {
            return [$optionKey];
        }

        return static::$attributeOptionMap[$attributeKey][$optionKey];
    }

    /**
     * @param string $attributeKey
     * @param array $optionKeys
     *
     * @return array
     */
    protected function getArrayOptions(string $attributeKey, array $optionKeys): array
    {
        $options = [];

        foreach ($optionKeys as $optionKey) {
            $options[] = array_key_exists($optionKey, static::$attributeOptionMap[$attributeKey]) ?
                static::$attributeOptionMap[$attributeKey][$optionKey] :
                $optionKey;
        }

        return $options;
    }

    /**
     * @param array $options
     *
     * @return array
     */
    private function getMultiSelectAttributeValue(array $options): array
    {
        $value = [];

        foreach ($options as $option) {
            foreach ($option as $locale => $optionValue) {
                $value[$locale][static::KEY_LOCALE] = $locale;

                // Concatenate with comma for multiselect values
                $value[$locale][static::KEY_DATA] = isset($value[$locale][static::KEY_DATA]) ?
                    $value[$locale][static::KEY_DATA] . ', ' . $optionValue :
                    $optionValue;
            }
        }

        return array_values($value);
    }

    /**
     * @param array $option
     *
     * @return array
     */
    private function getSimpleSelectAttributeValue($option): array
    {
        $value = [];

        foreach ($option as $locale => $optionValue) {
            $value[$locale][static::KEY_LOCALE] = $locale;
            $value[$locale][static::KEY_DATA] = $optionValue;
        }

        return array_values($value);
    }

    /**
     * @param string $attributeKey
     * @param mixed $attributeData
     *
     * @return array
     */
    private function getAttributeValue(string $attributeKey, $attributeData): array
    {
        if (is_array($attributeData)) {
            $options = $this->getArrayOptions($attributeKey, $attributeData);

            return $this->getMultiSelectAttributeValue($options);
        }

        $option = $this->getOptions($attributeKey, $attributeData);

        return $this->getSimpleSelectAttributeValue($option);
    }

    /**
     * @param string $attributeKey
     *
     * @return mixed
     */
    private function isAttributeLocalizable(string $attributeKey)
    {
        return static::$attributeLocalizableMap[$attributeKey];
    }
}
