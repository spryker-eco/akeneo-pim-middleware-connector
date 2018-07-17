<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin;

use Generated\Shared\Transfer\ValidatorConfigTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 */
class DefaultProductImportValidatorStagePlugin extends AbstractPlugin implements StagePluginInterface
{
    protected const PLUGIN_NAME = 'DefaultProductImportValidatorStagePlugin';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }

    /**
     * @param mixed $payload
     * @param \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface $outStream
     * @param mixed $originalPayload
     *
     * @return array|mixed
     */
    public function process($payload, WriteStreamInterface $outStream, $originalPayload)
    {
        return $this->getFactory()
            ->getProcessFacade()
            ->validate($payload, $this->getValidatorConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    protected function getValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFacade()
            ->getProductImportValidatorConfig();
    }
}
