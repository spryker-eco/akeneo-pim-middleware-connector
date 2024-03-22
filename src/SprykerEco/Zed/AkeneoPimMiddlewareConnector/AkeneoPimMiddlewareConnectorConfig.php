<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConstants;

class AkeneoPimMiddlewareConnectorConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getLocaleMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALE_MAP_FILE_PATH);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAttributeMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::ATTRIBUTE_MAP_FILE_PATH);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getSuperAttributeMapFilePath(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::SUPER_ATTRIBUTE_MAP_FILE_PATH);
    }

    /**
     * @api
     *
     * @return int
     */
    public function getFkCategoryTemplate(): int
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::FK_CATEGORY_TEMPLATE);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getTaxSet(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::TAX_SET);
    }

    /**
     * @api
     *
     * @return array
     */
    public function getLocalesForImport(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALES_FOR_IMPORT);
    }

    /**
     * @api
     *
     * @return array
     */
    public function getActiveStoresForProducts(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::ACTIVE_STORES_FOR_PRODUCTS);
    }

    /**
     * @api
     *
     * @return array
     */
    public function getLocaleToPriceMap(): array
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::LOCALES_TO_PRICE_MAP);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getDefaultParentCategoryKey(): string
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::DEFAULT_PARENT_CATEGORY_KEY, 'demoshop');
    }
}
