<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

interface AkeneoPimMiddlewareConnectorRepositoryInterface
{
    /**
     * @return array
     */
    public function getSkuList(): array;
}
