<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
