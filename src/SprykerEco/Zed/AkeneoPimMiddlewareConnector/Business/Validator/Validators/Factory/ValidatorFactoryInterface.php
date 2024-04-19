<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators\Factory;

use SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface;

interface ValidatorFactoryInterface
{
    /**
     * @param string $validatorClassName
     *
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface
     */
    public function createValidator(string $validatorClassName): ValidatorInterface;

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\Validators\ValidatorInterface
     */
    public function createProductAbstractExistValidator(): ValidatorInterface;
}
