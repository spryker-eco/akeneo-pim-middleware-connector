<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map;

use SprykerMiddleware\Zed\Process\Business\Mapper\Map\AbstractMap;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;

class AttributeMapPreparationMap extends AbstractMap
{
    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            'options' => function (array $value) {
                return [
                    'code' => $value['code'],
                    'type' => $value['type'],
                ];
            },
            'is_super' => 'code',
            'localizable' => 'localizable',
        ];
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return MapInterface::MAPPER_STRATEGY_COPY_UNKNOWN;
    }
}
