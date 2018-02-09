<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;

class AkeneoPimMiddlewareConnectorToProcessFacadeBridge implements AkeneoPimMiddlewareConnectorToProcessFacadeInterface
{
    /**
     * @var \SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface
     */
    protected $processFacade;

    /**
     * @param \SprykerMiddleware\Zed\Process\Business\ProcessFacadeInterface $processFacade
     */
    public function __construct($processFacade)
    {
        $this->processFacade = $processFacade;
    }

    /**
     * @api
     *
     * @param array $payload
     * @param \Generated\Shared\Transfer\MapperConfigTransfer $mapperConfigTransfer
     *
     * @return array
     */
    public function map(array $payload, MapperConfigTransfer $mapperConfigTransfer): array
    {
        return $this->processFacade->map($payload, $mapperConfigTransfer);
    }

    /**
     * @api
     *
     * @param array $payload
     * @param \Generated\Shared\Transfer\TranslatorConfigTransfer $translatorConfigTransfer
     * ß
     *
     * @return array
     */
    public function translate(array $payload, TranslatorConfigTransfer $translatorConfigTransfer): array
    {
        return $this->processFacade->translate($payload, $translatorConfigTransfer);
    }
}
