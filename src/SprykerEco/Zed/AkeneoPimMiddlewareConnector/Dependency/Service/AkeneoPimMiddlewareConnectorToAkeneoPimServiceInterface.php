<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
    public function getAllProducts(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllCategories(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributes(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllFamilies(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param string $code
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllFamilyVariants(string $code, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param string $attributeCode
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllAttributeOptions(string $attributeCode, int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;

    /**
     * @param int $pageSize
     * @param array $queryParameters
     *
     * @return \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursorInterface
     */
    public function getAllProductModels(int $pageSize = 10, array $queryParameters = []): AkeneoResourceCursorInterface;
}
