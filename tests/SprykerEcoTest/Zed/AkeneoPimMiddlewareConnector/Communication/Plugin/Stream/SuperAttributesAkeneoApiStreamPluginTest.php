<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream;

use Codeception\Test\Unit;

/**
 * Auto-generated group annotations
 *
 * @group SprykerEcoTest
 * @group Zed
 * @group AkeneoPimMiddlewareConnector
 * @group Communication
 * @group Plugin
 * @group Stream
 * @group SuperAttributesAkeneoApiStreamPluginTest
 * Add your own group annotations below this line
 */
class SuperAttributesAkeneoApiStreamPluginTest extends Unit
{
    /**
     * @var \SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorZedTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testSuperAttributeAkeneoReadStreamReturnsSameCodesAsExpected(): void
    {
        $this->assertSame(
            $this->tester->getExpectedVariantCodes(),
            $this->tester->processSuperAttributesAkeneoReadPlugin(),
        );
    }
}
