<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\ValidationRuleSet;

use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\AbstractValidationRuleSet;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface;

class ProductModelImportValidationRuleSet extends AbstractValidationRuleSet implements ValidationRuleSetInterface
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'categories' => [
                'Required',
                'NotBlank',
            ],
        ];
    }
}
