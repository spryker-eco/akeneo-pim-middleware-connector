<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

class SuperAttributeAkeneoApiReadStream extends AbstractAkeneoApiReadStream
{
    /**
     * @var \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    protected $cursorVariants;

    /**
     * @var string
     */
    protected const KEY_CODE = 'code';

    /**
     * @return bool
     */
    public function open(): bool
    {
        $this->cursor = $this->akeneoPimService
            ->getAllFamilies();

        return true;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        if (($this->cursorVariants !== null) && $this->cursorVariants->valid()) {
            return $this->cursorVariants->current();
        }

        $family = $this->cursor->current();
        $this->cursor->next();

        $this->cursorVariants = $this->akeneoPimService->getFamilyVariants($family[static::KEY_CODE]);

        return $this->cursorVariants->valid() ? $this->cursorVariants->current() : [];
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        $isValidCursorVariants = false;

        if ($this->cursorVariants !== null) {
            $this->cursorVariants->next();
            $isValidCursorVariants = $this->cursorVariants->valid();
        }

        return parent::eof() && !$isValidCursorVariants;
    }
}
