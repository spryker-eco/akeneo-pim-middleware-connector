<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConstants;

class AkeneoPimMiddlewareConnectorConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getLocaleMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALE_MAP_FILE_PATH);
    }

    /**
     * @return string
     */
    public function getAttributeMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::ATTRIBUTE_MAP_FILE_PATH);
    }

    /**
     * @return string
     */
    public function getSuperAttributeMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::SUPER_ATTRIBUTE_MAP_FILE_PATH);
    }

    /**
     * @return int
     */
    public function getFkCategoryTemplate(): int
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::FK_CATEGORY_TEMPLATE);
    }

    /**
     * @return string
     */
    public function getTaxSet(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::TAX_SET);
    }

    /**
     * @return array
     */
    public function getLocalesForImport(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALES_FOR_IMPORT);
    }

    /**
     * @return array
     */
    public function getActiveStoresForProducts(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::ACTIVE_STORES_FOR_PRODUCTS);
    }

    /**
     * @return array
     */
    public function getLocaleToPriceMap(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALES_TO_PRICE_MAP);
    }

    /**
     * @return string
     */
    public function getDefaultParentCategoryKey() : string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::DEFAULT_PARENT_CATEGORY_KEY);
    }
}
