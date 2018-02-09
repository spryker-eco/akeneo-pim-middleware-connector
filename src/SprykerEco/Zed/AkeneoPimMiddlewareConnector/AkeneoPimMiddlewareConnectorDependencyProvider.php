<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector;

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
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\LocaleMapImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductModelImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductModelPreparationConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\ProductPreparationConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Configuration\TaxSetMapImportConfigurationPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductModelImportMapperStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductModelImportTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductModelPreparationTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\ProductPreparationTranslationStagePlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\AttributeAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\CategoryAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\LocaleStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\ProductModelAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\TaxSetStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimBridge;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Iterator\NullIteratorPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Log\MiddlewareLoggerConfigPlugin;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Stream\JsonStreamPlugin;

class AkeneoPimMiddlewareConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    const SERVICE_AKENEO_PIM = 'SERVICE_AKENEO_PIM';

    const AKENEO_PIM_MIDDLEWARE_PROCESSES = 'AKENEO_PIM_MIDDLEWARE_PROCESSES';
    const AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG = 'AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG';

    const ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN = 'ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN';
    const ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN = 'ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN';
    const ATTRIBUTE_IMPORT_ITERATOR_PLUGIN = 'ATTRIBUTE_IMPORT_ITERATOR_PLUGIN';
    const ATTRIBUTE_IMPORT_STAGE_PLUGINS = 'ATTRIBUTE_IMPORT_STAGE_PLUGINS';
    const ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS = 'ATTRIBUTE_IMPORT_PRE_PROCESSOR_PLUGINS';
    const ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS = 'ATTRIBUTE_IMPORT_POST_PROCESSOR_PLUGINS';

    const ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN = 'ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN';
    const ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN = 'ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN';
    const ATTRIBUTE_MAP_ITERATOR_PLUGIN = 'ATTRIBUTE_MAP_ITERATOR_PLUGIN';
    const ATTRIBUTE_MAP_STAGE_PLUGINS = 'ATTRIBUTE_MAP_STAGE_PLUGINS';
    const ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS = 'ATTRIBUTE_MAP_PRE_PROCESSOR_PLUGINS';
    const ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS = 'ATTRIBUTE_MAP_POST_PROCESSOR_PLUGINS';

    const CATEGORY_IMPORT_INPUT_STREAM_PLUGIN = 'CATEGORY_IMPORT_INPUT_STREAM_PLUGIN';
    const CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN = 'CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN';
    const CATEGORY_IMPORT_ITERATOR_PLUGIN = 'CATEGORY_IMPORT_ITERATOR_PLUGIN';
    const CATEGORY_IMPORT_STAGE_PLUGINS = 'CATEGORY_IMPORT_STAGE_PLUGINS';
    const CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS = 'CATEGORY_IMPORT_PRE_PROCESSOR_PLUGINS';
    const CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS = 'CATEGORY_IMPORT_POST_PROCESSOR_PLUGINS';

    const LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN = 'LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN';
    const LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN = 'LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN';
    const LOCALE_MAP_IMPORT_ITERATOR_PLUGIN = 'LOCALE_MAP_IMPORT_ITERATOR_PLUGIN';
    const LOCALE_MAP_IMPORT_STAGE_PLUGINS = 'LOCALE_MAP_IMPORT_STAGE_PLUGINS';
    const LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS = 'LOCALE_MAP_IMPORT_PRE_PROCESSOR_PLUGINS';
    const LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS = 'LOCALE_MAP_IMPORT_POST_PROCESSOR_PLUGINS';

    const PRODUCT_IMPORT_INPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_INPUT_STREAM_PLUGIN';
    const PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN = 'PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN';
    const PRODUCT_IMPORT_ITERATOR_PLUGIN = 'PRODUCT_IMPORT_ITERATOR_PLUGIN';
    const PRODUCT_IMPORT_STAGE_PLUGINS = 'PRODUCT_IMPORT_STAGE_PLUGINS';
    const PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_PRE_PROCESSOR_PLUGINS';
    const PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS = 'PRODUCT_IMPORT_POST_PROCESSOR_PLUGINS';

    const PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN';
    const PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN';
    const PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN = 'PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN';
    const PRODUCT_MODEL_IMPORT_STAGE_PLUGINS = 'PRODUCT_MODEL_IMPORT_STAGE_PLUGINS';
    const PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_IMPORT_PRE_PROCESSOR_PLUGINS';
    const PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_IMPORT_POST_PROCESSOR_PLUGINS';

    const PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN = 'PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN';
    const PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN = 'PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN';
    const PRODUCT_PREPARATION_ITERATOR_PLUGIN = 'PRODUCT_PREPARATION_ITERATOR_PLUGIN';
    const PRODUCT_PREPARATION_STAGE_PLUGINS = 'PRODUCT_PREPARATION_STAGE_PLUGINS';
    const PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS = 'PRODUCT_PREPARATION_PRE_PROCESSOR_PLUGINS';
    const PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS = 'PRODUCT_PREPARATION_POST_PROCESSOR_PLUGINS';

    const PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN';
    const PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN = 'PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN';
    const PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN = 'PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN';
    const PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS = 'PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS';
    const PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_PREPARATION_PRE_PROCESSOR_PLUGINS';
    const PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS = 'PRODUCT_MODEL_PREPARATION_POST_PROCESSOR_PLUGINS';

    const TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN = 'TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN';
    const TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN = 'TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN';
    const TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN = 'TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN';
    const TAX_SET_MAP_IMPORT_STAGE_PLUGINS = 'TAX_SET_MAP_IMPORT_STAGE_PLUGINS';
    const TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS = 'TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS';
    const TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS = 'TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[static::SERVICE_AKENEO_PIM] = function (Container $container) {
            return new AkeneoPimMiddlewareConnectorToAkeneoPimBridge($container->getLocator()->akeneoPim()->service());
        };

        $container = $this->addAkeneoPimProcesses($container);
        $container = $this->addAttributeImportProcessPlugins($container);
        $container = $this->addAttributeMapProcessPlugins($container);
        $container = $this->addCategoryImportProcessPlugins($container);
        $container = $this->addLocaleMapImportProcessPlugins($container);
        $container = $this->addProductImportProcessPlugins($container);
        $container = $this->addProductModelImportProcessPlugins($container);
        $container = $this->addProductModelPreparationProcessPlugins($container);
        $container = $this->addProductPreparationProcessPlugins($container);
        $container = $this->addTaxSetMapImportProcessPlugins($container);

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
            return $this->getAkeneoPimProceseesPluginsStack();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Configuration\ProcessConfigurationPluginInterface[]
     */
    protected function getAkeneoPimProceseesPluginsStack(): array
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
            new TaxSetMapImportConfigurationPlugin(),
        ];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDefaultLoggerConfigPlugin($container)
    {
        $container[static::AKENEO_PIM_MIDDLEWARE_LOGGER_CONFIG] = function () {
            return $this->getDefaultLoggerConfigPlugin();
        };

        return $container;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Log\MiddlewareLoggerConfigPluginInterface
     */
    protected function getDefaultLoggerConfigPlugin()
    {
        return new MiddlewareLoggerConfigPlugin();
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAttributeImportProcessPlugins(Container $container)
    {
        $container[static::ATTRIBUTE_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new AttributeAkeneoApiStreamPlugin();
        };
        $container[static::ATTRIBUTE_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::ATTRIBUTE_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::ATTRIBUTE_IMPORT_STAGE_PLUGINS] = function () {
            return [];
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
    protected function addAttributeMapProcessPlugins(Container $container)
    {
        $container[static::ATTRIBUTE_MAP_INPUT_STREAM_PLUGIN] = function () {
            return new AttributeAkeneoApiStreamPlugin();
        };
        $container[static::ATTRIBUTE_MAP_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::ATTRIBUTE_MAP_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::ATTRIBUTE_MAP_STAGE_PLUGINS] = function () {
            return [
                new AttributeMapPreparationMapperStagePlugin(),
                new AttributeMapTranslationStagePlugin(),
                new AttributeMapMapperStagePlugin(),
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
    protected function addCategoryImportProcessPlugins(Container $container)
    {
        $container[static::CATEGORY_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new CategoryAkeneoApiStreamPlugin();
        };
        $container[static::CATEGORY_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::CATEGORY_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::CATEGORY_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new CategoryImportTranslationStagePlugin(),
                new CategoryMapperStagePlugin(),
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
    protected function addLocaleMapImportProcessPlugins(Container $container)
    {
        $container[static::LOCALE_MAP_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new LocaleStreamPlugin();
        };
        $container[static::LOCALE_MAP_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::LOCALE_MAP_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::LOCALE_MAP_IMPORT_STAGE_PLUGINS] = function () {
            return [];
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
    protected function addProductImportProcessPlugins(Container $container)
    {
        $container[static::PRODUCT_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };
        $container[static::PRODUCT_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::PRODUCT_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new ProductImportTranslationStagePlugin(),
                new ProductMapperStagePlugin(),
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
    protected function addProductModelImportProcessPlugins(Container $container)
    {
        $container[static::PRODUCT_MODEL_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new JsonStreamPlugin();
        };
        $container[static::PRODUCT_MODEL_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::PRODUCT_MODEL_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_MODEL_IMPORT_STAGE_PLUGINS] = function () {
            return [
                new ProductModelImportTranslationStagePlugin(),
                new ProductModelImportMapperStagePlugin(),
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
    protected function addProductPreparationProcessPlugins(Container $container)
    {
        $container[static::PRODUCT_PREPARATION_INPUT_STREAM_PLUGIN] = function () {
            return new ProductAkeneoApiStreamPlugin();
        };
        $container[static::PRODUCT_PREPARATION_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::PRODUCT_PREPARATION_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_PREPARATION_STAGE_PLUGINS] = function () {
            return [
                new ProductPreparationTranslationStagePlugin(),
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
    protected function addProductModelPreparationProcessPlugins(Container $container)
    {
        $container[static::PRODUCT_MODEL_PREPARATION_INPUT_STREAM_PLUGIN] = function () {
            return new ProductModelAkeneoApiStreamPlugin();
        };
        $container[static::PRODUCT_MODEL_PREPARATION_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::PRODUCT_MODEL_PREPARATION_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::PRODUCT_MODEL_PREPARATION_STAGE_PLUGINS] = function () {
            return [
                new ProductModelPreparationTranslationStagePlugin(),
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
    protected function addTaxSetMapImportProcessPlugins(Container $container)
    {
        $container[static::TAX_SET_MAP_IMPORT_INPUT_STREAM_PLUGIN] = function () {
            return new TaxSetStreamPlugin();
        };
        $container[static::TAX_SET_MAP_IMPORT_OUTPUT_STREAM_PLUGIN] = function () {
        };

        $container[static::TAX_SET_MAP_IMPORT_ITERATOR_PLUGIN] = function () {
            return new NullIteratorPlugin();
        };

        $container[static::TAX_SET_MAP_IMPORT_STAGE_PLUGINS] = function () {
            return [];
        };

        $container[static::TAX_SET_MAP_IMPORT_PRE_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        $container[static::TAX_SET_MAP_IMPORT_POST_PROCESSOR_PLUGINS] = function () {
            return [];
        };

        return $container;
    }
}
