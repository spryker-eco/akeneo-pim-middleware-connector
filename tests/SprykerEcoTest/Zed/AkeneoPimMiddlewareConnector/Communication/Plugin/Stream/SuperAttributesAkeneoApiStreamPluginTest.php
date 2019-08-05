<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream;

use Codeception\TestCase\Test;

/**
 * Auto-generated group annotations
 * @group SprykerEcoTest
 * @group Zed
 * @group AkeneoPimMiddlewareConnector
 * @group Communication
 * @group Plugin
 * @group Stream
 * @group SuperAttributesAkeneoApiStreamPluginTest
 * Add your own group annotations below this line
 */
class SuperAttributesAkeneoApiStreamPluginTest extends Test
{
    /**
     * @var \SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorZedTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testThatSuperAttributeAkeneoReadStreamReturnsSameCodesAsExpected(): void
    {
        $this->assertSame(
            $this->tester->getExpectedVariantCodes(),
            $this->tester->processSuperAttributesAkeneoReadPlugin()
        );
    }
}
