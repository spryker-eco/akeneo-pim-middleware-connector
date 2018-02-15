<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Shared\Process\ProcessConfig;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;

class AttributeMapImportMap extends AbstractMap
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'attribute_key' => 'code',
            'key' => 'code',
            'allow_input' => function () {
                return false;
            },
            'is_multiple' => function () {
                return false;
            },
            'input_type' => function () {
                return 'text';
            },
            'type' => 'type',
            'group' => 'group',
            'options' => 'options',
//            'metric_family' => 'metric_family',
            'is_super' => 'is_super',
            'localizedAttributes' => 'labels',
            'localizable' => 'localizable',
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
