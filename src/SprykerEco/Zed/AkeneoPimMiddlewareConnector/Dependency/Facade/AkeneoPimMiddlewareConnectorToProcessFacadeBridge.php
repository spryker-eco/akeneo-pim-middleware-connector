<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;

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
     * @param array $payload
     * @param \Generated\Shared\Transfer\TranslatorConfigTransfer $translatorConfigTransfer
     *
     * @return array
     */
    public function translate(array $payload, TranslatorConfigTransfer $translatorConfigTransfer): array
    {
        return $this->processFacade->translate($payload, $translatorConfigTransfer);
    }

    /**
     * @param array $payload
     * @param \Generated\Shared\Transfer\ValidatorConfigTransfer $validationConfigTransfer
     *
     * @return array
     */
    public function validate(array $payload, ValidatorConfigTransfer $validationConfigTransfer): array
    {
        return $this->processFacade->validate($payload, $validationConfigTransfer);
    }
}
