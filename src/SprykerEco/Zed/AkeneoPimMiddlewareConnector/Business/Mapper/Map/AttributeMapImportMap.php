<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

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
        return MapInterface::MAPPER_STRATEGY_SKIP_UNKNOWN;
    }
}
