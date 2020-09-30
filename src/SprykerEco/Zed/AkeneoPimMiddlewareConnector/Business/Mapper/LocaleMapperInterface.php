<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper;

interface LocaleMapperInterface
{
    /**
     * @param array $payload
     *
     * @return array
     */
    public function map(array $payload): array;
}
