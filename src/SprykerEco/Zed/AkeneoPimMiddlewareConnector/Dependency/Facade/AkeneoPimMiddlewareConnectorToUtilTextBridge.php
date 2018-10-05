<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

class AkeneoPimMiddlewareConnectorToUtilTextBridge implements AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface
{
    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @param \Spryker\Service\UtilText\UtilTextServiceInterface $utilTextService
     */
    public function __construct($utilTextService)
    {
        $this->utilTextService = $utilTextService;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function generateSlug(string $value): string
    {
        return $this->utilTextService->generateSlug($value);
    }
}
