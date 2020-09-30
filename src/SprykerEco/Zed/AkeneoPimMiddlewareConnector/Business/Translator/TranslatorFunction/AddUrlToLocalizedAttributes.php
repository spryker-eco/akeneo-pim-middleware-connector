<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddUrlToLocalizedAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    protected const KEY_NAME = 'name';
    protected const KEY_URL = 'url';

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface
     */
    protected $urlGenerator;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator\UrlGeneratorStrategyInterface $urlGenerator
     */
    public function __construct(UrlGeneratorStrategyInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        $value[static::KEY_URL] = $this->urlGenerator->generate($value[static::KEY_NAME], $value['attributes']['idLocale'], $payload['identifier'] ?? $payload['code']);
        unset($value['attributes']['idLocale']);

        return $value;
    }
}
