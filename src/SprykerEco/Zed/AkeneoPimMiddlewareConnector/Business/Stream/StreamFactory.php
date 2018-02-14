<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\AttributeAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\CategoryAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\ProductAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo\ProductModelAkeneoApiReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\DataImport\CategoryWriteStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Db\PropelCriteriaReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Json\JsonObjectWriteStream;
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
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $categoryImporterPlugin
     */
    public function __construct(
        AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService,
        AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer,
        DataImporterPluginInterface $categoryImporterPlugin
    ) {
        $this->akeneoPimService = $akeneoPimService;
        $this->queryContainer = $queryContainer;
        $this->categoryImporterPlugin = $categoryImporterPlugin;
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
        return new PropelCriteriaReadStream($this->queryContainer->createSpyTaxSetQuery());
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createLocaleReadStream(): ReadStreamInterface
    {
        return new PropelCriteriaReadStream($this->queryContainer->createSpyLocaleQuery());
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
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createCategoryWriteStream(): WriteStreamInterface
    {
        return new CategoryWriteStream($this->categoryImporterPlugin);
    }
}