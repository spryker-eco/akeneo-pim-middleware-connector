<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service;

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
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProducts($pageSize = 10, array $queryParameters = [])
    {
        return $this->akeneoPimService
            ->getAllProducts($pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllCategories($pageSize = 10, array $queryParameters = [])
    {
        return $this->akeneoPimService
            ->getAllCategories($pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributes($pageSize = 10, array $queryParameters = [])
    {
        return $this->akeneoPimService
            ->getAllAttributes($pageSize, $queryParameters);
    }

    /**
     * @param string $attributeCode
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributeOptions($attributeCode, $pageSize = 10, array $queryParameters = [])
    {
        return $this->akeneoPimService
            ->getAllAttributeOptions($attributeCode, $pageSize, $queryParameters);
    }

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProductModels($pageSize = 10, array $queryParameters = [])
    {
        return $this->akeneoPimService
            ->getAllProductModels($pageSize, $queryParameters);
    }
}
