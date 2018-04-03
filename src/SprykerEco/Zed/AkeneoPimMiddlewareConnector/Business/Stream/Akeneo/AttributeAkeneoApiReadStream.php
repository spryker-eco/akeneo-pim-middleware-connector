<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

class AttributeAkeneoApiReadStream extends AbstractAkeneoApiReadStream
{
    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->cursor = $this->akeneoPimService
            ->getAllAttributes();

        return true;
    }
}
