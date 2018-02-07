<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Dependency\Plugin\TranslatorFunction\TranslatorFunctionPluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 */
class AddAttributeOptionsTranslatorFunctionPlugin implements TranslatorFunctionPluginInterface
{
    const NAME = 'AddAttributeOptions';

    /**
     * @return string
     */
    public function getName()
    {
        return static::NAME;
    }

    /**
     * @param mixed $value
     * @param array $payload
     * @param string $key
     * @param array $options
     *
     * @return mixed
     */
    public function translate($value, array $payload, string $key, array $options)
    {
        $translatorFunction = $this->getFactory()
            ->createTranslatorFunctionFactory()
            ->createAddAttributeOptionsTranslatorFunction();
        $translatorFunction->setKey($key);
        $translatorFunction->setOptions($options);

        return $translatorFunction->translate($value, $payload);
    }
}
