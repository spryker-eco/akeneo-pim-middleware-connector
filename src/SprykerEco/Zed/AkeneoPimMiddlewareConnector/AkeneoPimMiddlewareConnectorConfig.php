<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace  SprykerEco\Zed\AkeneoPimMiddlewareConnector;

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
    public function getDefaultFkCategoryTemplate(): int
    {
        return $this->get(AkeneoPimMiddlewareConnectorConstants::DEFAULT_FK_CATEGORY_TEMPLATE);
    }
}
