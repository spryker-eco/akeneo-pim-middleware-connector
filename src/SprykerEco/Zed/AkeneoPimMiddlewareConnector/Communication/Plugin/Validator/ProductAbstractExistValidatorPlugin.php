<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Validator;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators\ProductAbstractExistValidator;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\AbstractGenericValidatorPlugin;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 */
class ProductAbstractExistValidatorPlugin extends AbstractGenericValidatorPlugin
{
    public const NAME = 'ProductAbstractExist';

    public const KEY_NAME = 'name';
    public const KEY_URL = 'url';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function getValidatorClassName(): string
    {
        return ProductAbstractExistValidator::class;
    }

    /**
     * @param mixed $value
     * @param array $payload
     * @param string $key
     * @param array $options
     *
     * @return bool
     */
    public function validate($value, array $payload, string $key, array $options): bool
    {
        $validator = $this->getFactory()
            ->createValidatorFactory()
            ->createProductAbstractExistValidator()
            ->setKey($key)
            ->setOptions($options);
        $validator->setKey($key);
        $validator->setOptions($options);

        return $validator->validate($value, $payload);
    }
}
