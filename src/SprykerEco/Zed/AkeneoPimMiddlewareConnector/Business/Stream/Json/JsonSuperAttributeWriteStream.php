<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Json;

use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

class JsonSuperAttributeWriteStream implements WriteStreamInterface
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
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->handle = fopen($this->path, 'w');

        if ($this->handle === false) {
            return false;
        }

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
     * @param array $data
     *
     * @return int
     */
    public function write(array $data): int
    {
        if (array_key_exists('variant_attribute_sets', $data)) {
            foreach ($data['variant_attribute_sets'] as $axes) {
                foreach ($axes['axes'] as $axe) {
                    !in_array($axe, $this->data) ? $this->data[] = $axe : null;
                }
            }
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
