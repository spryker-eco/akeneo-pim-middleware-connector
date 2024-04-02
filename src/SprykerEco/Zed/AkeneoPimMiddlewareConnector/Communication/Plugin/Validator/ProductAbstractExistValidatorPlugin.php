<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Validator;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\Validators\ProductAbstractExistValidator;
use SprykerMiddleware\Zed\Process\Communication\Plugin\Validator\AbstractGenericValidatorPlugin;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 */
class ProductAbstractExistValidatorPlugin extends AbstractGenericValidatorPlugin
{
    /**
     * @var string
     */
    public const NAME = 'ProductAbstractExist';

    /**
     * @var string
     */
    public const KEY_NAME = 'name';

    /**
     * @var string
     */
    public const KEY_URL = 'url';

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getValidatorClassName(): string
    {
        return ProductAbstractExistValidator::class;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
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

        return $validator->validate($value, $payload);
    }
}
