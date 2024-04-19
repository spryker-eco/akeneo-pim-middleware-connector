<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\AttributeAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\CategoryAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\ProductAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\ProductModelAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\SuperAttributeAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\DataImport\DataImportProductConcreteWriteStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\DataImport\DataImportWriteStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Db\PropelCriteriaReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Json\JsonObjectWriteStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Json\JsonSuperAttributeWriteStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;

class StreamFactory implements StreamFactoryInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    protected $akeneoPimService;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $categoryImporterPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $attributeImporterPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $productAbstractImporterPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $productConcreteImporterPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $productPriceImporterPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $productAbstractStoresImporterPlugin;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $categoryImporterPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $attributeImporterPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $productAbstractImporterPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $productConcreteImporterPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $productPriceImporterPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $productAbstractStoresImporterPlugin
     */
    public function __construct(
        AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService,
        AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer,
        DataImporterPluginInterface $categoryImporterPlugin,
        DataImporterPluginInterface $attributeImporterPlugin,
        DataImporterPluginInterface $productAbstractImporterPlugin,
        DataImporterPluginInterface $productConcreteImporterPlugin,
        DataImporterPluginInterface $productPriceImporterPlugin,
        DataImporterPluginInterface $productAbstractStoresImporterPlugin
    ) {
        $this->akeneoPimService = $akeneoPimService;
        $this->queryContainer = $queryContainer;
        $this->categoryImporterPlugin = $categoryImporterPlugin;
        $this->attributeImporterPlugin = $attributeImporterPlugin;
        $this->productConcreteImporterPlugin = $productConcreteImporterPlugin;
        $this->productAbstractImporterPlugin = $productAbstractImporterPlugin;
        $this->productPriceImporterPlugin = $productPriceImporterPlugin;
        $this->productAbstractStoresImporterPlugin = $productAbstractStoresImporterPlugin;
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createAttributeAkeneoApiReadStream(): ReadStreamInterface
    {
        return new AttributeAkeneoApiReadStream($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createSuperAttributesAkeneoApiReadStream(): ReadStreamInterface
    {
        return new SuperAttributeAkeneoApiReadStream($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createCategoryAkeneoApiReadStream(): ReadStreamInterface
    {
        return new CategoryAkeneoApiReadStream($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createProductAkeneoApiReadStream(): ReadStreamInterface
    {
        return new ProductAkeneoApiReadStream($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createProductModelAkeneoApiReadStream(): ReadStreamInterface
    {
        return new ProductModelAkeneoApiReadStream($this->akeneoPimService);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createTaxSetReadStream(): ReadStreamInterface
    {
        return new PropelCriteriaReadStream($this->queryContainer->querySelectSpyTaxSet());
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createLocaleReadStream(): ReadStreamInterface
    {
        return new PropelCriteriaReadStream($this->queryContainer->querySelectLocale());
    }

    /**
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createJsonObjectWriteStream(string $path): WriteStreamInterface
    {
        return new JsonObjectWriteStream($path);
    }

    /**
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createJsonSuperAttributeWriteStream(string $path): WriteStreamInterface
    {
        return new JsonSuperAttributeWriteStream($path);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createCategoryWriteStream(): WriteStreamInterface
    {
        return new DataImportWriteStream($this->categoryImporterPlugin);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createProductAbstractWriteStream(): WriteStreamInterface
    {
        return new DataImportWriteStream($this->productAbstractImporterPlugin);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createProductConcreteWriteStream(): WriteStreamInterface
    {
        return new DataImportProductConcreteWriteStream($this->productConcreteImporterPlugin, $this->productAbstractImporterPlugin, $this->productPriceImporterPlugin, $this->productAbstractStoresImporterPlugin);
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createAttributeWriteStream(): WriteStreamInterface
    {
        return new DataImportWriteStream($this->attributeImporterPlugin);
    }
}
