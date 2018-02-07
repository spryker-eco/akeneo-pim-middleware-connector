<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin;

use Generated\Shared\Transfer\MapperConfigTransfer;
use SprykerMiddleware\Zed\Process\Communication\Plugin\AbstractMapperStagePlugin;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 */
class CategoryMapperStagePlugin extends AbstractMapperStagePlugin
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getMapperConfig(): MapperConfigTransfer
    {
        return $this->getFacade()
            ->getCategoryImportMapperConfig();
    }
}
