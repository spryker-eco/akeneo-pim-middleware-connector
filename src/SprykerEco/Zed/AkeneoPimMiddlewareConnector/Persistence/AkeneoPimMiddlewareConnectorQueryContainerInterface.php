<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence;

use Propel\Runtime\ActiveQuery\ModelCriteria;

interface AkeneoPimMiddlewareConnectorQueryContainerInterface
{
    /**
     * @api
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function querySelectSpyTaxSet(): ModelCriteria;

    /**
     * @api
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function querySelectLocale(): ModelCriteria;
}
