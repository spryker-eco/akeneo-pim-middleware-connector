<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

interface AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function generateSlug($value): string;
}
