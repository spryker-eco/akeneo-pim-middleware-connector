<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\DataImport;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

class DataImportProductConcreteWriteStream implements WriteStreamInterface
{
    public const KEY_ABSTRACT_SKU = 'abstract_sku';
    public const KEY_CONCRETE_SKU = 'concrete_sku';

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterConcretePlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterAbstractPlugin;

    /**
     * @var array
     */
    protected $concreteData;

    /**
     * @var array
     */
    protected $abstractData;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterConcretePlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterAbstractPlugin
     */
    public function __construct(DataImporterPluginInterface $dataImporterConcretePlugin, DataImporterPluginInterface $dataImporterAbstractPlugin)
    {
        $this->dataImporterConcretePlugin = $dataImporterConcretePlugin;
        $this->dataImporterAbstractPlugin = $dataImporterAbstractPlugin;
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->concreteData = [];
        $this->abstractData = [];

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
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
    public function write(array $data): int
    {
        if (is_null($data[static::KEY_ABSTRACT_SKU])) {
            $data[static::KEY_ABSTRACT_SKU] = $data[static::KEY_CONCRETE_SKU] . '_abstract';
            $this->abstractData[] = $data;
        }

        $this->concreteData[] = $data;

        if (count($this->concreteData) > 200) {
            $this->flush();
        }

        return 1;
    }

    /**
     * @return bool
     */
    public function flush(): bool
    {
        $this->dataImporterAbstractPlugin->import($this->abstractData);
        $this->dataImporterConcretePlugin->import($this->concreteData);

        $this->concreteData = [];
        $this->abstractData = [];

        return true;
    }
}
