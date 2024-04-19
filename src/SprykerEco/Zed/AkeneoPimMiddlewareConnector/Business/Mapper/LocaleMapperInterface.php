<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper;

interface LocaleMapperInterface
{
    /**
     * @param array $payload
     *
     * @return array
     */
    public function map(array $payload): array;
}
