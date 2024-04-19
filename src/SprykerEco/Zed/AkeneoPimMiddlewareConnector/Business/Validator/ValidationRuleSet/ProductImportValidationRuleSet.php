<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\ValidationRuleSet;

use SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface;

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
                'ProductAbstractExist',
            ],
            'categories' => [
                'NotBlank',
            ],
        ];
    }
}
