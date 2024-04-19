<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

interface AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function generateSlug(string $value): string;
}
