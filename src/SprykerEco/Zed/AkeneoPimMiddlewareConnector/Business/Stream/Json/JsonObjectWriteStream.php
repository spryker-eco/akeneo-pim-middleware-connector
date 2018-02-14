<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Json;

use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

class JsonObjectWriteStream implements WriteStreamInterface
{
    /**
     * @var resource
     */
    protected $handle;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $mode = '';

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $mode
     *
     * @return bool
     */
    public function open(string $mode): bool
    {
        $this->handle = fopen($this->path, $mode);

        if ($this->handle === false) {
            return false;
        }

        $this->mode = $mode;

        return true;
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
    public function close(): bool
    {
        if ($this->handle) {
            return fclose($this->handle);
        }

        return false;
    }

    /**
     * @throws \SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException
     *
     * @return bool
     */
    public function eof(): bool
    {
        throw new MethodNotSupportedException();
    }

    /**
     * @param mixed $data
     *
     * @return int
     */
    public function write($data): int
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        return 1;
    }

    /**
     * @return bool
     */
    public function flush(): bool
    {
        fwrite($this->handle, json_encode($this->data));

        return fflush($this->handle);
    }
}
