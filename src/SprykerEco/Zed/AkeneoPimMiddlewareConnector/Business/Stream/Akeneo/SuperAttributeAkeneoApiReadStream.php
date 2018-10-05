<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\Akeneo;

class SuperAttributeAkeneoApiReadStream extends AbstractAkeneoApiReadStream
{
    /**
     * @var \SprykerEco\Service\AkeneoPim\Dependencies\External\Api\Wrapper\AkeneoResourceCursor
     */
    protected $cursorVariants;

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
        if ($this->cursorVariants !== null) {
            $this->cursorVariants->next();
            if ($this->cursorVariants->valid()) {
                return $this->cursorVariants->current();
            }
        }

        $family = $this->cursor->current();
        $this->cursor->next();

        $this->cursorVariants = $this->akeneoPimService->getFamilyVariants($family[static::KEY_CODE]);

        return $this->cursorVariants->valid() ? $this->cursorVariants->current() : [];
    }
}
