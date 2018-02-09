<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

class CategoryAkeneoApiReadStream extends AbstractAkeneoApiReadStream
{
    /**
     * @param string $mode
     *
     * @return bool
     */
    public function open(string $mode): bool
    {
        $this->cursor = $this->akeneoPimService
            ->getAllCategories();

        return true;
    }
}
