<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service;

use SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface;

interface AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
{
    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProducts($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllCategories($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributes($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param string $attributeCode
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributeOptions($attributeCode, $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProductModels($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;
}
