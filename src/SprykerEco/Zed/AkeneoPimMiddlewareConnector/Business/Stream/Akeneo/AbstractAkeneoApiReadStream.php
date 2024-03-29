<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\StreamInterface;

abstract class AbstractAkeneoApiReadStream implements StreamInterface, ReadStreamInterface
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    protected $akeneoPimService;

    /**
     * @var \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    protected $cursor;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @return array
     */
    public function read(): array
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function get(): array
    {
        $item = $this->cursor
            ->current();
        $this->cursor->next();

        return $item;
    }

    /**
     * @return bool
     */
    abstract public function open(): bool;

    /**
     * @return bool
     */
    public function close(): bool
    {
        unset($this->cursor);

        return true;
    }

    /**
     * @param int $offset
     * @param int $whence
     *
     * @return int
     */
    public function seek(int $offset, int $whence): int
    {
        return -1;
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        return !$this->cursor->valid();
    }
}
