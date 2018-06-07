<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorDependencyProvider;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactoryInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategy;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\TranslatorFunctionFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\TranslatorFunctionFactoryInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProcessFacadeInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 */
class AkeneoPimMiddlewareConnectorCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\TranslatorFunctionFactoryInterface
     */
    public function createTranslatorFunctionFactory(): TranslatorFunctionFactoryInterface
    {
        return new TranslatorFunctionFactory($this->getAkeneoPimService(), $this->createUrlGeneratorStrategy());
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactoryInterface
     */
    public function createStreamFactory(): StreamFactoryInterface
    {
        return new StreamFactory(
            $this->getAkeneoPimService(),
            $this->getQueryContainer(),
            $this->getCategoryImporterPlugin(),
            $this->getAttributeImporterPlugin(),
            $this->getProductAbstractImporterPlugin(),
            $this->getProductConcreteImporterPlugin(),
            $this->getProductPriceImporterPlugin(),
            $this->getProductAbstractStoresImporterPlugin()
        );
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getAkeneoPimProcesses(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_PROCESSES);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    public function getAkeneoPimTranslatorFunctions(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProcessFacadeInterface
     */
    public function getProcessFacade(): AkeneoPimMiddlewareConnectorToProcessFacadeInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::FACADE_PROCESS);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    protected function getAkeneoPimService(): AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SERVICE_AKENEO_PIM);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    public function getAkeneoPimLoggerConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getProductImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getProductImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getAttributeImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getAttributeImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getAttributeImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getAttributeImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getAttributeImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getAttributeImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getAttributeMapInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getAttributeMapIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getAttributeMapPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getAttributeMapStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getAttributeMapPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getAttributeMapOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getCategoryImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getCategoryImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getCategoryImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getCategoryImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getCategoryImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getCategoryImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getLocaleMapInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getLocaleMapIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getLocaleMapPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getLocaleMapStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getLocaleMapPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getLocaleMapOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductModelImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductModelImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getProductModelImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductModelImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getProductModelImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductModelImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductModelPreparationInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductModelPreparationIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getProductModelPreparationPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductModelPreparationStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getProductModelPreparationPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductModelPreparationOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getProductPreparationInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getSuperAttributesImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getSuperAttributesImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getProductPreparationIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getSuperAttributesImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getProductPreparationPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getSuperAttributesImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getProductPreparationStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getSuperAttributesImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getProductPreparationPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getSuperAttributesImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SUPER_ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getProductPreparationOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface
     */
    public function getTaxSetMapImportInputStreamPlugin(): InputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Iterator\ProcessIteratorPluginInterface
     */
    public function getTaxSetMapImportIteratorPlugin(): ProcessIteratorPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PreProcessorHookPluginInterface[][]
     */
    public function getTaxSetMapImportPreProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getTaxSetMapImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Hook\PostProcessorHookPluginInterface[][]
     */
    public function getTaxSetMapImportPostProcessorPluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\OutputStreamPluginInterface
     */
    public function getTaxSetMapImportOutputStreamPlugin(): OutputStreamPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected function getCategoryImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_CATEGORY_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected function getAttributeImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_ATTRIBUTE_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected function getProductAbstractImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected function getProductConcreteImporterPlugin()
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_PRODUCT_CONCRETE_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    public function getDefaultAkeneoPimProcesses()
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::DEFAULT_AKENEO_PIM_MIDDLEWARE_PROCESSES);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    public function getDefaultAkeneoPimTranslatorFunctions()
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::DEFAULT_AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getDefaultCategoryImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::DEFAULT_CATEGORY_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getDefaultProductImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::DEFAULT_PRODUCT_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\StagePluginInterface[]
     */
    public function getDefaultProductModelImportStagePluginsStack(): array
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::DEFAULT_PRODUCT_MODEL_IMPORT_STAGE_PLUGINS);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    public function getProductPriceImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_PRODUCT_PRICE_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    public function getProductAbstractStoresImporterPlugin(): DataImporterPluginInterface
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_STORES_IMPORTER_PLUGIN);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface
     */
    public function createUrlGeneratorStrategy(): UrlGeneratorStrategyInterface
    {
        return new UrlGeneratorStrategy($this->getUtilTextService());
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface
     */
    public function getUtilTextService()
    {
        return $this->getProvidedDependency(AkeneoPimMiddlewareConnectorDependencyProvider::SERVICE_UTIL_TEXT);
    }
}
