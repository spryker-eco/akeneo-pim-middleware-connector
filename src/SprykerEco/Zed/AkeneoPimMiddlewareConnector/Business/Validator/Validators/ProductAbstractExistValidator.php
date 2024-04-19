<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface;
use SprykerMiddleware\Zed\Process\Business\Validator\Validators\AbstractValidator;

class ProductAbstractExistValidator extends AbstractValidator
{
    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface
     */
    protected $productFacade;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface $productFacade
     */
    public function __construct(AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface $productFacade)
    {
        $this->productFacade = $productFacade;
    }

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return bool
     */
    public function validate($value, array $payload): bool
    {
        if ($value == null) {
            return true;
        }

        return (bool)$this->productFacade->findProductAbstractIdBySku($value);
    }
}
