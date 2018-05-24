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
    public const KEY_ABSTRACT_SKU = 'abstract_sku';
    public const KEY_CONCRETE_SKU = 'concrete_sku';
    public const KEY_PRICES = 'prices';
    public const KEY_STORES = 'stores';

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
     * @var $storesData
     */
    protected $storesData;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterConcretePlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterAbstractPlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImporterPricePlugin
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface $dataImportAbstractStoresPlugin
     */
    public function __construct(
        DataImporterPluginInterface $dataImporterConcretePlugin,
        DataImporterPluginInterface $dataImporterAbstractPlugin,
        DataImporterPluginInterface $dataImporterPricePlugin,
        DataImporterPluginInterface $dataImportAbstractStoresPlugin
    )
    {
        $this->dataImporterConcretePlugin = $dataImporterConcretePlugin;
        $this->dataImporterAbstractPlugin = $dataImporterAbstractPlugin;
        $this->dataImporterPricePlugin = $dataImporterPricePlugin;
        $this->dataImportAbstractStoresPlugin = $dataImportAbstractStoresPlugin;
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
            $data[static::KEY_ABSTRACT_SKU] = $this->createAbstractSKU($data[static::KEY_CONCRETE_SKU]);
            $this->abstractData[] = $data;
        }

        if (is_array($data[static::KEY_PRICES])) {
            foreach ($data[static::KEY_PRICES] as $price) {
                $price['abstract_sku'] = $data[static::KEY_ABSTRACT_SKU] ?? $this->createAbstractSKU($data[static::KEY_CONCRETE_SKU]);
                $this->pricesData[] = $price;
            }
        }

        if (is_array($data[static::KEY_STORES])) {
            foreach ($data[static::KEY_STORES] as $store) {
                $this->storesData[] = [
                    'product_abstract_sku' => $data[static::KEY_ABSTRACT_SKU] ?? $this->createAbstractSKU($data[static::KEY_CONCRETE_SKU]),
                    'store_name' => $store
                ];
            }
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
        $this->dataImportAbstractStoresPlugin->import($this->storesData);
        $this->dataImporterPricePlugin->import($this->pricesData);

        $this->concreteData = [];
        $this->abstractData = [];
        $this->storesData = [];
        $this->pricesData = [];

        return true;
    }

    /**
     * @param string $sku
     *
     * @return string
     */
    protected function createAbstractSKU(string $sku): string
    {
        return $sku . '_abstract';
    }
}
