<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Db;

use Propel\Runtime\ActiveQuery\ModelCriteria;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Shared\Process\Stream\StreamInterface;

class PropelCriteriaReadStream implements StreamInterface, ReadStreamInterface
{
    /**
     * @var \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected $modelCriteria;

    /**
     * @var \Propel\Runtime\Collection\CollectionIterator
     */
    protected $iterator;

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $modelCriteria
     */
    public function __construct(ModelCriteria $modelCriteria)
    {
        $this->modelCriteria = $modelCriteria;
    }

    /**
     * @return mixed
     */
    public function read()
    {
        return $this->get();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $item = $this->iterator
            ->current();
        $this->iterator->next();

        return $item;
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->iterator = $this->modelCriteria
            ->find()
            ->getIterator();

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        unset($this->iterator);

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
        if ($whence === SEEK_SET) {
            $this->iterator->seek($offset);

            return 0;
        }

        return -1;
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        return !$this->iterator->valid();
    }
}
