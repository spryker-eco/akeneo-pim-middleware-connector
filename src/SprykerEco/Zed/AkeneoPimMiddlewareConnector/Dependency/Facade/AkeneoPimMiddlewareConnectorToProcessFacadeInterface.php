<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;

interface AkeneoPimMiddlewareConnectorToProcessFacadeInterface
{
    /**
     * @param array $payload
     * @param \Generated\Shared\Transfer\MapperConfigTransfer $mapperConfigTransfer
     *
     * @return array
     */
    public function map(array $payload, MapperConfigTransfer $mapperConfigTransfer): array;

    /**
     * @param array $payload
     * @param \Generated\Shared\Transfer\TranslatorConfigTransfer $translatorConfigTransfer
     *
     * @return array
     */
    public function translate(array $payload, TranslatorConfigTransfer $translatorConfigTransfer): array;

    /**
     * @param array $payload
     * @param \Generated\Shared\Transfer\ValidatorConfigTransfer $validationConfigTransfer
     *
     * @return array
     */
    public function validate(array $payload, ValidatorConfigTransfer $validationConfigTransfer): array;
}
