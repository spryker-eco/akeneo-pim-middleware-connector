<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\AttributeMapMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\AttributeMapPreparationMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\AttributeMapTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\CategoryImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\CategoryMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\AttributeImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\AttributeMapConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\CategoryImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\DefaultCategoryImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\DefaultProductImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\DefaultProductModelImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\LocaleMapImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductModelImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductModelPreparationConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductPreparationConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\SuperAttributeImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\TaxSetMapImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultCategoryImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultCategoryMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultProductImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultProductImportValidatorStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultProductModelImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\DefaultProductModelImportValidatorStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\LocaleMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductModelImportMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductModelImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\AttributeAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\AttributeWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\CategoryAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\CategoryWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\JsonObjectWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\JsonSuperAttributeWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\LocaleStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductAbstractWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductConcreteWriteStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductModelAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\SuperAttributesAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\TaxSetStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TaxSetMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddAbstractSkuIfNotExistTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddAttributeOptionsTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddAttributeValuesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddFamilyAttributeTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddMissingAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddMissingLocalesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AddUrlToLocalizedAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\AttributeEmptyTranslationToKeyTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\DefaultPriceSelectorTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\DefaultValuesToLocalizedAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\EnrichAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\LabelsToLocaleIdsTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\LabelsToLocalizedAttributeNamesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\LocaleKeysToIdsTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\MarkAsSuperAttributeTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\MeasureUnitToIntTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\MoveLocalizedAttributesToAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\PriceSelectorTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\SkipItemsWithoutParentTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\ValuesToAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction\ValuesToLocalizedAttributesTranslatorFunctionPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Validator\ProductAbstractExistValidatorPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProcessFacadeBridge;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProductFacadeBridge;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToUtilTextBridge;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceBridge;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonInputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonOutputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowInputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonRowOutputStreamPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamReaderStagePlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\StreamWriterStagePlugin;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface;

class AkeneoPimMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SERVICE_AKENEO_PIM = 'SERVICE_AKENEO_PIM';
    public const SERVICE_UTIL_TEXT = 'SERVICE_UTIL_TEXT';
    public const FACADE_PROCESS = 'FACADE_PROCESS';
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    public const DEFAULT_AKENEO_PIM_MIDDLEWARE_PROCESSES = 'DEFAULT_AKENEO_PIM_MIDDLEWARE_PROCESSES';
    public const DEFAULT_AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS = 'DEFAULT_AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS';

    public const PRODUCT_ABSTRACT_QUERY = 'PRODUCT_ABSTRACT_QUERY';

    public const URL_GENERATOR_STRATEGY = 'URL_GENERATOR_STRATEGY';

    public const AKENEO_PIM_MIDDLEWARE_PROCESSES = 'AKENEO_PIM_MIDDLEWARE_PROCESSES';
    public const AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG = 'AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG';
    public const AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS = 'AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS';
    public const AKENEO_PIM_MIDDLEWARE_VALIDATORS = 'AKENEO_PIM_MIDDLEWARE_VALIDATORS';
    public const AKENEO_PIM_MIDDLEWARE_CATEGORY_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_CATEGORY_IMPORTER_PLUGIN';
    public const AKENEO_PIM_MIDDLEWARE_ATTRIBUTE_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_ATTRIBUTE_IMPORTER_PLUGIN';
    public const AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_IMPORTER_PLUGIN';
    public const AKENEO_PIM_MIDDLEWARE_PRODUCT_CONCRETE_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_PRODUCT_CONCRETE_IMPORTER_PLUGIN';
    public const AKENEO_PIM_MIDDLEWARE_PRODUCT_PRICE_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_PRODUCT_PRICE_IMPORTER_PLUGIN';
    public const AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_STORES_IMPORTER_PLUGIN = 'AKENEO_PIM_MIDDLEWARE_PRODUCT_ABSTRACT_STORES_IMPORTER_PLUGIN';

    public const ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN = 'ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN';
    public const ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN = 'ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const ATTRIBUTE_IMPORT_ITERATOR_PLUGIN = 'ATTRIBUTE_IMPORT_ITERATOR_PLUGIN';
    public const ATTRIBUTE_IMPORT_STAGE_PLUGINS = 'ATTRIBUTE_IMPORT_STAGE_PLUGINS';
    public const ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS = 'ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS = 'ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS';

    public const ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN = 'ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN';
    public const ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN = 'ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN';
    public const ATTRIBUTE_MAP_ITERATOR_PLUGIN = 'ATTRIBUTE_MAP_ITERATOR_PLUGIN';
    public const ATTRIBUTE_MAP_STAGE_PLUGINS = 'ATTRIBUTE_MAP_STAGE_PLUGINS';
    public const ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS = 'ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS';
    public const ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS = 'ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS';

    public const CATEGORY_IMPORT_INPUT_STREAM_PLUGIN = 'CATEGORY_IMPORT_INPUT_STREAM_PLUGIN';
    public const CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN = 'CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const CATEGORY_IMPORT_ITERATOR_PLUGIN = 'CATEGORY_IMPORT_ITERATOR_PLUGIN';
    public const CATEGORY_IMPORT_STAGE_PLUGINS = 'CATEGORY_IMPORT_STAGE_PLUGINS';
    public const CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS = 'CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS = 'CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS';

    public const LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN = 'LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN';
    public const LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN = 'LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const LOCALE_MAP_IMPORT_ITERATOR_PLUGIN = 'LOCALE_MAP_IMPORT_ITERATOR_PLUGIN';
    public const LOCALE_MAP_IMPORT_STAGE_PLUGINS = 'LOCALE_MAP_IMPORT_STAGE_PLUGINS';
    public const LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS = 'LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS = 'LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS';

    public const PRODUCT_IMPORT_INPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_INPUT_STREAM_PLUGIN';
    public const PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const PRODUCT_IMPORT_ITERATOR_PLUGIN = 'PRODUCT_IMPORT_ITERATOR_PLUGIN';
    public const PRODUCT_IMPORT_STAGE_PLUGINS = 'PRODUCT_IMPORT_STAGE_PLUGINS';
    public const PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS';

    public const PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN';
    public const PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN = 'PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN';
    public const PRODUCT_MODEL_IMPORT_STAGE_PLUGINS = 'PRODUCT_MODEL_IMPORT_STAGE_PLUGINS';
    public const PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS';

    public const PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN = 'PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN';
    public const PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN = 'PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN';
    public const PRODUCT_PREPARATION_ITERATOR_PLUGIN = 'PRODUCT_PREPARATION_ITERATOR_PLUGIN';
    public const PRODUCT_PREPARATION_STAGE_PLUGINS = 'PRODUCT_PREPARATION_STAGE_PLUGINS';
    public const PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS = 'PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS';
    public const PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS = 'PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS';

    public const PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN';
    public const PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN';
    public const PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN = 'PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN';
    public const PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS = 'PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS';
    public const PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS';
    public const PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS';

    public const SUPER_ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN = 'SUPER_ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN';
    public const SUPER_ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN = 'SUPER_ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const SUPER_ATTRIBUTE_IMPORT_ITERATOR_PLUGIN = 'SUPER_ATTRIBUTE_IMPORT_ITERATOR_PLUGIN';
    public const SUPER_ATTRIBUTE_IMPORT_STAGE_PLUGINS = 'SUPER_ATTRIBUTE_IMPORT_STAGE_PLUGINS';
    public const SUPER_ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS = 'SUPER_ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const SUPER_ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS = 'SUPER_ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS';

    public const TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN = 'TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN';
    public const TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN = 'TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN';
    public const TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN = 'TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN';
    public const TAX_SET_MAP_IMPORT_STAGE_PLUGINS = 'TAX_SET_MAP_IMPORT_STAGE_PLUGINS';
    public const TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS = 'TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS';
    public const TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS = 'TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS';

    public const DEFAULT_CATEGORY_IMPORT_STAGE_PLUGINS = 'DEFAULT_CATEGORY_IMPORT_STAGE_PLUGINS';
    public const DEFAULT_PRODUCT_MODEL_IMPORT_STAGE_PLUGINS = 'DEFAULT_PRODUCT_MODEL_IMPORT_STAGE_PLUGINS';
    public const DEFAULT_PRODUCT_IMPORT_STAGE_PLUGINS = 'DEFAULT_PRODUCT_IMPORT_STAGE_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = $this->addServiceAkeneoPim($container);
        $container = $this->addFacadeProcess($container);
        $container = $this->addFacadeProduct($container);
        $container = $this->addServiceUtilText($container);
        $container = $this->addCategoryDataImporterPlugin($container);
        $container = $this->addAttributeDataImporterPlugin($container);
        $container = $this->addProductAbstractDataImporterPlugin($container);
        $container = $this->addProductConcreteDataImporterPlugin($container);
        $container = $this->addDefaultLoggerConfigPlugin($container);
        $container = $this->addAkeneoPimProcesses($container);
        $container = $this->addDefaultAkeneoPimProcesses($container);
        $container = $this->addAkeneoPimTranslatorFunctions($container);
        $container = $this->addAkeneoPimValidators($container);
        $container = $this->addDefaultAkeneoPimTranslatorFunctions($container);
        $container = $this->addAttributeImportProcessPlugins($container);
        $container = $this->addAttributeMapProcessPlugins($container);
        $container = $this->addCategoryImportProcessPlugins($container);
        $container = $this->addLocaleMapImportProcessPlugins($container);
        $container = $this->addProductImportProcessPlugins($container);
        $container = $this->addProductModelImportProcessPlugins($container);
        $container = $this->addProductModelPreparationProcessPlugins($container);
        $container = $this->addProductPreparationProcessPlugins($container);
        $container = $this->addTaxSetMapImportProcessPlugins($container);
        $container = $this->addSuperAttributeImportProcessPlugins($container);
        $container = $this->addDefaultCategoryImportStagePlugins($container);
        $container = $this->addDefaultProductImportStagePlugins($container);
        $container = $this->addDefaultProductModelImportStagePlugins($container);
        $container = $this->addProductPriceDataImporterPlugin($container);
        $container = $this->addProductAbstractStoresDataImporterPlugin($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = $this->addProductAbstractQuery($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAkeneoPimProcesses(Container $container): Container
    {
        $container[static::AKENEO_PIM_MIDDLEWARE_PROCESSES] = function () {
            return $this->getAkeneoPimProcessesPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addServiceAkeneoPim(Container $container): Container
    {
        $container[static::SERVICE_AKENEO_PIM] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToAkeneoPimServiceBridge($container->getLocator()->akeneoPim()->service());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeProcess(Container $container): Container
    {
        $container[static::FACADE_PROCESS] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToProcessFacadeBridge($container->getLocator()->process()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFacadeProduct(Container $container): Container
    {
        $container[static::FACADE_PRODUCT] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToProductFacadeBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addServiceUtilText(Container $container): Container
    {
        $container[static::SERVICE_UTIL_TEXT] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToUtilTextBridge($container->getLocator()->utilText()->service());
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getAkeneoPimProcessesPlugins(): array
    {
        return [
            new AttributeImportConfigurationPlugin(),
            new AttributeMapConfigurationPlugin(),
            new CategoryImportConfigurationPlugin(),
            new LocaleMapImportConfigurationPlugin(),
            new ProductImportConfigurationPlugin(),
            new ProductModelImportConfigurationPlugin(),
            new ProductModelPreparationConfigurationPlugin(),
            new ProductPreparationConfigurationPlugin(),
            new SuperAttributeImportConfigurationPlugin(),
            new TaxSetMapImportConfigurationPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultAkeneoPimProcesses(Container $container): Container
    {
        $container[static::DEFAULT_AKENEO_PIM_MIDDLEWARE_PROCESSES] = function () {
            return $this->getDefaultAkeneoPimProcessesPlugins();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getDefaultAkeneoPimProcessesPlugins(): array
    {
        return [
            new DefaultCategoryImportConfigurationPlugin(),
            new DefaultProductImportConfigurationPlugin(),
            new DefaultProductModelImportConfigurationPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultLoggerConfigPlugin($container): Container
    {
        $container[static::AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG] = function () {
            return $this->getDefaultLoggerConfigPlugin();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    protected function getDefaultLoggerConfigPlugin(): MiddlewareLoggerConfigPluginInterface
    {
        return new MiddlewareLoggerConfigPlugin();
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAttributeImportProcessPlugins(Container $container): Container
    {
        $container[static::ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new AttributeAkeneoApiStreamPlugin();
        };
        $container[static::ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new AttributeWriteStreamPlugin();
        };

        $container[static::ATTRIBUTE_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::ATTRIBUTE_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new AttributeMapPreparationMapperStagePlugin(),
                new AttributeMapTranslationStagePlugin(),
                new AttributeMapMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAttributeMapProcessPlugins(Container $container): Container
    {
        $container[static::ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN] = function () {
            return new AttributeAkeneoApiStreamPlugin();
        };
        $container[static::ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonOutputStreamPlugin();
        };

        $container[static::ATTRIBUTE_MAP_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::ATTRIBUTE_MAP_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new AttributeMapPreparationMapperStagePlugin(),
                new AttributeMapTranslationStagePlugin(),
                new AttributeMapMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryImportProcessPlugins(Container $container): Container
    {
        $container[static::CATEGORY_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new CategoryAkeneoApiStreamPlugin();
        };
        $container[static::CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new CategoryWriteStreamPlugin();
        };

        $container[static::CATEGORY_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::CATEGORY_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new CategoryMapperStagePlugin(),
                new CategoryImportTranslationStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleMapImportProcessPlugins(Container $container): Container
    {
        $container[static::LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new LocaleStreamPlugin();
        };
        $container[static::LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonObjectWriteStreamPlugin();
        };

        $container[static::LOCALE_MAP_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::LOCALE_MAP_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new LocaleMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductImportProcessPlugins(Container $container): Container
    {
        $container[static::PRODUCT_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonRowInputStreamPlugin();
        };
        $container[static::PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new ProductConcreteWriteStreamPlugin();
        };

        $container[static::PRODUCT_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new DefaultProductImportValidatorStagePlugin(),
                new ProductImportTranslationStagePlugin(),
                new ProductMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductModelImportProcessPlugins(Container $container): Container
    {
        $container[static::PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonInputStreamPlugin();
        };
        $container[static::PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new ProductAbstractWriteStreamPlugin();
        };

        $container[static::PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_MODEL_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new DefaultProductModelImportValidatorStagePlugin(),
                new ProductModelImportTranslationStagePlugin(),
                new ProductModelImportMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductPreparationProcessPlugins(Container $container): Container
    {
        $container[static::PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN] = function () {
            return new ProductAkeneoApiStreamPlugin();
        };
        $container[static::PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonRowOutputStreamPlugin();
        };

        $container[static::PRODUCT_PREPARATION_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_PREPARATION_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductModelPreparationProcessPlugins(Container $container): Container
    {
        $container[static::PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN] = function () {
            return new ProductModelAkeneoApiStreamPlugin();
        };
        $container[static::PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonOutputStreamPlugin();
        };

        $container[static::PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addTaxSetMapImportProcessPlugins(Container $container): Container
    {
        $container[static::TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new TaxSetStreamPlugin();
        };
        $container[static::TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonObjectWriteStreamPlugin();
        };

        $container[static::TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::TAX_SET_MAP_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new TaxSetMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSuperAttributeImportProcessPlugins(Container $container): Container
    {
        $container[static::SUPER_ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new SuperAttributesAkeneoApiStreamPlugin();
        };

        $container[static::SUPER_ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
            return new JsonSuperAttributeWriteStreamPlugin();
        };

        $container[static::SUPER_ATTRIBUTE_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::SUPER_ATTRIBUTE_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        $container[static::SUPER_ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::SUPER_ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAkeneoPimTranslatorFunctions($container): Container
    {
        $container[static::AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS] = function () {
            return $this->getAkeneoPimTranslatorFunctionPlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAkeneoPimValidators($container): Container
    {
        $container[static::AKENEO_PIM_MIDDLEWARE_VALIDATORS] = function () {
            return $this->getAkeneoPimValidatorPlugins();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    protected function getAkeneoPimTranslatorFunctionPlugins(): array
    {
        return [
            new AddAbstractSkuIfNotExistTranslatorFunctionPlugin(),
            new AddAttributeOptionsTranslatorFunctionPlugin(),
            new AddAttributeValuesTranslatorFunctionPlugin(),
            new AddFamilyAttributeTranslatorFunctionPlugin(),
            new AddMissingAttributesTranslatorFunctionPlugin(),
            new AddMissingLocalesTranslatorFunctionPlugin(),
            new AddUrlToLocalizedAttributesTranslatorFunctionPlugin(),
            new AttributeEmptyTranslationToKeyTranslatorFunctionPlugin(),
            new EnrichAttributesTranslatorFunctionPlugin(),
            new LabelsToLocalizedAttributeNamesTranslatorFunctionPlugin(),
            new LocaleKeysToIdsTranslatorFunctionPlugin(),
            new MarkAsSuperAttributeTranslatorFunctionPlugin(),
            new MeasureUnitToIntTranslatorFunctionPlugin(),
            new MoveLocalizedAttributesToAttributesTranslatorFunctionPlugin(),
            new PriceSelectorTranslatorFunctionPlugin(),
            new ValuesToAttributesTranslatorFunctionPlugin(),
            new ValuesToLocalizedAttributesTranslatorFunctionPlugin(),
            new MeasureUnitToIntTranslatorFunctionPlugin(),
            new LabelsToLocaleIdsTranslatorFunctionPlugin(),
            new SkipItemsWithoutParentTranslatorFunctionPlugin(),
        ];
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Validator\GenericValidatorPluginInterface[]
     */
    protected function getAkeneoPimValidatorPlugins(): array
    {
        return [
            new ProductAbstractExistValidatorPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultAkeneoPimTranslatorFunctions($container): Container
    {
        $container[static::DEFAULT_AKENEO_PIM_MIDDLEWARE_TRANSLATOR_FUNCTIONS] = function () {
            return $this->getDefaultAkeneoPimTranslatorFunctionPlugins();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface[]
     */
    protected function getDefaultAkeneoPimTranslatorFunctionPlugins(): array
    {
        return [
            new DefaultPriceSelectorTranslatorFunctionPlugin(),
            new DefaultValuesToLocalizedAttributesTranslatorFunctionPlugin(),
            new SkipItemsWithoutParentTranslatorFunctionPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAttributeDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductConcreteDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductPriceDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractStoresDataImporterPlugin(Container $container): Container
    {
        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultCategoryImportStagePlugins($container): Container
    {
        $container[static::DEFAULT_CATEGORY_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new DefaultCategoryMapperStagePlugin(),
                new DefaultCategoryImportTranslationStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultProductImportStagePlugins($container): Container
    {
        $container[static::DEFAULT_PRODUCT_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new DefaultProductImportValidatorStagePlugin(),
                new DefaultProductImportTranslationStagePlugin(),
                new ProductMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultProductModelImportStagePlugins($container): Container
    {
        $container[static::DEFAULT_PRODUCT_MODEL_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new StreamReaderStagePlugin(),
                new DefaultProductModelImportValidatorStagePlugin(),
                new DefaultProductModelImportTranslationStagePlugin(),
                new ProductModelImportMapperStagePlugin(),
                new StreamWriterStagePlugin(),
            ];
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductAbstractQuery($container): Container
    {
        $container[static::PRODUCT_ABSTRACT_QUERY] = function () {
            return SpyProductAbstractQuery::create();
        };

        return $container;
    }
}
