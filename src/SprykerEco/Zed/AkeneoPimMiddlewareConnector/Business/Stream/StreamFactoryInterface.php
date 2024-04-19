<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream;

use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;

interface StreamFactoryInterface
{
    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createAttributeAkeneoApiReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createSuperAttributesAkeneoApiReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createCategoryAkeneoApiReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createProductAkeneoApiReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createProductModelAkeneoApiReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createTaxSetReadStream(): ReadStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function createLocaleReadStream(): ReadStreamInterface;

    /**
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createJsonObjectWriteStream(string $path);

    /**
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createJsonSuperAttributeWriteStream(string $path): WriteStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createCategoryWriteStream(): WriteStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createAttributeWriteStream(): WriteStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createProductAbstractWriteStream(): WriteStreamInterface;

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface
     */
    public function createProductConcreteWriteStream(): WriteStreamInterface;
}
