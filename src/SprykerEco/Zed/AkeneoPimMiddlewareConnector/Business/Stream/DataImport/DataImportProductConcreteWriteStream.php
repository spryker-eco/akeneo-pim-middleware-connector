<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\DataImport;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerMiddleware\Shared\Process\Stream\WriteStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Exception\MethodNotSupportedException;

class DataImportProductConcreteWriteStream implements WriteStreamInterface
{
    protected const KEY_ABSTRACT_SKU = 'abstract_sku';
    protected const KEY_CONCRETE_SKU = 'concrete_sku';
    protected const KEY_PRICES = 'prices';
    protected const KEY_STORES = 'stores';
    protected const ABSTRACT_PRODUCT_CREATION_IDENTIFIER = 'abstract_product_creation';

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterConcretePlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterAbstractPlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImporterPricePlugin;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface
     */
    protected $dataImportAbstractStoresPlugin;

    /**
     * @var array
     */
    protected $concreteData;

    /**
     * @var array
     */
    protected $abstractData;

    /**
     * @var array
     */
    protected $pricesData;

    /**
     * @var array
     */
    protected $storesData;

    /**
     * @var int
     */
    protected $bufferSize;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterConcretePlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterAbstractPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterPricePlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImportAbstractStoresPlugin
     * @param int $bufferSize
     */
    public function __construct(
        DataImporterPluginInterface $dataImporterConcretePlugin,
        DataImporterPluginInterface $dataImporterAbstractPlugin,
        DataImporterPluginInterface $dataImporterPricePlugin,
        DataImporterPluginInterface $dataImportAbstractStoresPlugin,
        int $bufferSize = 30
    ) {
        $this->dataImporterConcretePlugin = $dataImporterConcretePlugin;
        $this->dataImporterAbstractPlugin = $dataImporterAbstractPlugin;
        $this->dataImporterPricePlugin = $dataImporterPricePlugin;
        $this->dataImportAbstractStoresPlugin = $dataImportAbstractStoresPlugin;
        $this->bufferSize = $bufferSize;
    }

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->concreteData = [];
        $this->abstractData = [];
        $this->pricesData = [];
        $this->storesData = [];

        return true;
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        $this->flush();

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
     * @param array $data
     *
     * @return int
     */
    public function write(array $data): int
    {
        if ($data[static::ABSTRACT_PRODUCT_CREATION_IDENTIFIER]) {
            $this->abstractData[] = $data;
        }

        if (is_array($data[static::KEY_PRICES])) {
            foreach ($data[static::KEY_PRICES] as $price) {
                $price['abstract_sku'] = $data[static::KEY_ABSTRACT_SKU];
                $this->pricesData[] = $price;
            }
        }

        if (is_array($data[static::KEY_STORES])) {
            foreach ($data[static::KEY_STORES] as $store) {
                $this->storesData[] = [
                    'product_abstract_sku' => $data[static::KEY_ABSTRACT_SKU],
                    'store_name' => $store,
                ];
            }
        }

        $this->concreteData[] = $data;

        if (count($this->concreteData) > $this->bufferSize) {
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
        $this->dataImportAbstractStoresPlugin->import($this->storesData);
        $this->dataImporterPricePlugin->import($this->pricesData);

        $this->concreteData = [];
        $this->abstractData = [];
        $this->storesData = [];
        $this->pricesData = [];

        return true;
    }
}
