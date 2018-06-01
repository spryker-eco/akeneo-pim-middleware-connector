<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
    public function generateSlug($value): string
    {
        return $this->utilTextService->generateSlug($value);
    }
}
