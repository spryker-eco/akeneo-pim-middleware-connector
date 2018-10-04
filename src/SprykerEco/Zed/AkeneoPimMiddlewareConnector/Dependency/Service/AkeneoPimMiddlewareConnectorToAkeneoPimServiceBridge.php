<?php

/**
 * MIT License
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
    public function getAllProducts($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getAllCategories($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getAllAttributes($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getAllFamilies($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getFamilyVariants(string $code, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getAllAttributeOptions($attributeCode, $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
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
    public function getAllProductModels($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface
    {
        return $this->akeneoPimService
            ->getAllProductModels($pageSize, $queryParameters);
    }
}
