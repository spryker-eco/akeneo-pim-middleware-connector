<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service;

use SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface;

interface AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
{
    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProducts($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllCategories($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributes($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllFamilies($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param string $code
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getFamilyVariants(string $code, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param string $attributeCode
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributeOptions($attributeCode, $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProductModels($pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;
}
