<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

interface AkeneoPimMiddlewareConnectorQueryContainerInterface
{
    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyTaxSetQuery();

    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyLocaleQuery();
}
