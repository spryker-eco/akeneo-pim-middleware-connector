<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\Repository;

interface ProductAbstractRepositoryInterface
{
    /**
     * @return string
     */
    public function getSkuValues(): string;
}
