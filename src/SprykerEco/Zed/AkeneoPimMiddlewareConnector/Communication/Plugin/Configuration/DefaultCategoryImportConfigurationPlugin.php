<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 */
class DefaultCategoryImportConfigurationPlugin extends AbstractPlugin implements ProcessConfigurationPluginInterface
{
    /**
     * @var string
     */
    protected const PROCESS_NAME = 'DEFAULT_CATEGORY_IMPORT_PROCESS';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getProcessName(): string
    {
        return static::PROCESS_NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getFactory()
            ->getCategoryImportInputStreamPlugin();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getFactory()
            ->getCategoryImportOutputStreamPlugin();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getFactory()
            ->getCategoryImportIteratorPlugin();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface>
     */
    public function getStagePlugins(): array
    {
        return $this->getFactory()
            ->getDefaultCategoryImportStagePluginsStack();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function getLoggerPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getFactory()
            ->getAkeneoPimLoggerConfigPlugin();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface>
     */
    public function getPreProcessorHookPlugins(): array
    {
        return $this->getFactory()
            ->getCategoryImportPreProcessorPluginsStack();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<\SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface>
     */
    public function getPostProcessorHookPlugins(): array
    {
        return $this->getFactory()
            ->getCategoryImportPostProcessorPluginsStack();
    }
}
