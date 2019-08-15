<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\AkeneoResourceCursorStub;

use SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface;

class TestResourceCursorStub implements AkeneoResourceCursorInterface
{
    protected const PAGE_SIZE = 10;

    /**
     * @var array
     */
    private $cursorData;

    /**
     * @param array $cursorData
     */
    public function __construct(array $cursorData)
    {
        $this->cursorData = $cursorData;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return static::PAGE_SIZE;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->cursorData);
    }

    /**
     * @return void
     */
    public function next(): void
    {
        next($this->cursorData);
    }

    /**
     * @return int|string
     */
    public function key()
    {
        return key($this->cursorData);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return ($this->key() !== null);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        reset($this->cursorData);
    }
}
