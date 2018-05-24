<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddUrlToLocalizedAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_NAME = 'name';
    protected const KEY_URL = 'url';

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface
     */
    protected $facade;

    public function __construct(AkeneoPimMiddlewareConnectorFacadeInterface $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $value[static::KEY_URL] = $this->facade->generateProductUrl($value[static::KEY_NAME], $value['attributes']['idLocale'], $payload['identifier'] ?? $payload['code']);

        return $value;
    }
}
