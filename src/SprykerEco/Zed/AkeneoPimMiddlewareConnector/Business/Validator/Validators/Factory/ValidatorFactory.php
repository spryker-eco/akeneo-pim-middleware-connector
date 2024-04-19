<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators\Factory;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators\ProductAbstractExistValidator;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToProductFacadeBridgeInterface;
use SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface;

class ValidatorFactory implements ValidatorFactoryInterface
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
     * @param string $validatorClassName
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface
     */
    public function createValidator(string $validatorClassName): ValidatorInterface
    {
        return new $validatorClassName();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface
     */
    public function createProductAbstractExistValidator(): ValidatorInterface
    {
        return new ProductAbstractExistValidator($this->productFacade);
    }
}
