<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
