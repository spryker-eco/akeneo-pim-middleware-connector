<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service;

use SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface;

class AkeneoPimMiddlewareConnectorToAkeneoPimServiceBridge implements AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
{
    /**
     * @var \SprykerEco\Service\AkeneoPim\AkeneoPimServiceInterface
     */
    protected $akeneoPimService;

    /**
     * @param \SprykerEco\Service\AkeneoPim\AkeneoPimServiceInterface $akeneoPimService
     */
    public function __construct($akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProducts(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllProducts($pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllCategories(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllCategories($pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllAttributes(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllAttributes($pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllFamilies(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllFamilies($pageSize, $queryParameters);
    }

    /**
     * @param string $code
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllFamilyVariants(string $code, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllFamilyVariants($code, $pageSize, $queryParameters);
    }

    /**
     * @param string $attributeCode
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllAttributeOptions(string $attributeCode, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllAttributeOptions($attributeCode, $pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    public function getAllProductModels(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllProductModels($pageSize, $queryParameters);
    }
}
