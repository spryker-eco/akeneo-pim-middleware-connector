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
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Db\PropelCriteriaReadStream;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistance\AkeneoPimMiddlewareConnectorQueryContainerInterface;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;

class StreamFactory implements StreamFactoryInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface
     */
    protected $akeneoPimService;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistance\AkeneoPimMiddlewareConnectorQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistance\AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer
     */
    public function __construct(
        AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService,
        AkeneoPimMiddlewareConnectorQueryContainerInterface $queryContainer
    ) {
        $this->akeneoPimService = $akeneoPimService;
        $this->queryContainer = $queryContainer;
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
}
