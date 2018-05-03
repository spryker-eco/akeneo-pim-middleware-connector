<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\ValidationRuleSet;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface;
use SprykerMiddleware\Zed\Process\Business\Validator\Validators\InListValidator;

class ProductImportValidationRuleSet extends AbstractValidationRuleSet implements ValidationRuleSetInterface
{
    /**
     * @var string[]
     */
    protected static $skuValues;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig $config
     */
    public function __construct(AkeneoPimMiddlewareConnectorConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'parent' => [
                [
                    'InList',
                    'options' => [
                        InListValidator::OPTION_VALUES => $this->getSkuValues(),
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string[]
     */
    protected function getSkuValues(): array
    {
        if (empty(static::$skuValues)) {
            static::$skuValues = json_decode(file_get_contents($this->config->getSkuValuesFilePath()), true);
        }

        return static::$skuValues;
    }
}
