<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
