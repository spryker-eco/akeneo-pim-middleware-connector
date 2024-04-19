<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin;

use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 */
class DefaultProductImportTranslationStagePlugin extends AbstractPlugin implements StagePluginInterface
{
    protected const PLUGIN_NAME = 'DefaultProductImportTranslationStagePlugin';

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    protected function getTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFacade()
            ->getDefaultProductImportTranslatorConfig();
    }

    /**
     * @api
     *
     * @param array $payload
     * @param \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface $outStream
     * @param mixed $originalPayload
     *
     * @return array
     */
    public function process($payload, WriteStreamInterface $outStream, $originalPayload)
    {
        return $this->getFactory()
            ->getProcessFacade()
            ->translate($payload, $this->getTranslatorConfig());
    }

    /**
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }
}
