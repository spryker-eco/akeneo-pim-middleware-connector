<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

class ProductModelAkeneoApiReadStream extends AbstractAkeneoApiReadStream
{
    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->cursor = $this->akeneoPimService
            ->getAllProductModels();

        return true;
    }
}
