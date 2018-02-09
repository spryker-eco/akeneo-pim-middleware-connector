<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\StreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

abstract class AbstractAkeneoApiReadStream implements StreamInterface, ReadStreamInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface
     */
    protected $akeneoPimService;

    /**
     * @var \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    protected $cursor;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @return mixed
     */
    public function read(): array
    {
        return $this->get();
    }

    /**
     * @return mixed
     */
    public function get(): array
    {
        $item = $this->cursor
            ->current();
        $this->cursor->next();
        return $item;
    }

    /**
     * @param string $mode
     *
     * @return bool
     */
    abstract public function open(string $mode): bool;

    /**
     * @return bool
     */
    public function close(): bool
    {
        unset($this->cursor);
    }

    /**
     * @param int $offset
     * @param int $whence
     *
     * @throws \SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException
     *
     * @return int
     */
    public function seek(int $offset, int $whence): int
    {
        throw new MethodNotSupportedException();
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        return !$this->cursor->valid();
    }
}
