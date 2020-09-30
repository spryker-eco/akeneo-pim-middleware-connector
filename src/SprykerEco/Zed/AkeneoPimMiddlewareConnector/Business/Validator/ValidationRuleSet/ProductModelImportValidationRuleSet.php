<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
