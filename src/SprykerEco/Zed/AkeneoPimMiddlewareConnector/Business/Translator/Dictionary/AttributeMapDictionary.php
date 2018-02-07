<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary;

use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\AbstractDictionary;

class AttributeMapDictionary extends AbstractDictionary
{
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
                        'pageSize' => 100, //@todo maybe hand on injected value from config?
                    ],
                ],
            ],
            'labels' => [
                'LabelsToLocalizedAttributeNames',
                [
                    'LocaleKeysToIds',
                    'options' => [
                        'map' => $this->getLocaleMap(),
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
        $content = file_get_contents(APPLICATION_ROOT_DIR . '/data/import/maps/locale_map.json');

        return json_decode($content, true);
    }

    /**
     * @return array
     */
    protected function getSuperAttributeMap(): array
    {
        //@todo inject path from configuration
        $content = file_get_contents(APPLICATION_ROOT_DIR . '/data/import/maps/super_attribute_map.json');

        return json_decode($content, true);
    }
}
