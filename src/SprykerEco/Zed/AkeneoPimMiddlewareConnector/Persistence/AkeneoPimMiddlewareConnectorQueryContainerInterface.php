<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Propel\Runtime\ActiveQuery\ModelCriteria;

interface AkeneoPimMiddlewareConnectorQueryContainerInterface
{
    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyTaxSetQuery(): ModelCriteria;

    /**
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function createSpyLocaleQuery(): ModelCriteria;
}
