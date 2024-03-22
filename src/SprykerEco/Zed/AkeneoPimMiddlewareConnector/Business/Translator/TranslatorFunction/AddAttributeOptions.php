<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use Iterator;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class AddAttributeOptions extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    /**
     * @var array
     */
    protected const ATTRIBUTE_TYPES_WITH_OPTIONS = [
        'pim_catalog_simpleselect',
        'pim_catalog_multiselect',
    ];

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface
     */
    private $akeneoPimService;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService)
    {
        $this->akeneoPimService = $akeneoPimService;
    }

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return array
     */
    public function translate($value, array $payload): array
    {
        if (!in_array($value['type'], static::ATTRIBUTE_TYPES_WITH_OPTIONS)) {
            return [];
        }

        return $this->getAttributeOptions($value['code']);
    }

    /**
     * @param string $code
     *
     * @return array
     */
    protected function getAttributeOptions(string $code): array
    {
        $options = [];
        foreach ($this->getIterator($code) as $option) {
            $options[$option['code']] = $option['labels'];
        }

        return $options;
    }

    /**
     * @param string $code
     *
     * @return \Iterator
     */
    protected function getIterator(string $code): Iterator
    {
        return $this->akeneoPimService->getAllAttributeOptions($code, $this->options['pageSize'] ?? 100);
    }
}
