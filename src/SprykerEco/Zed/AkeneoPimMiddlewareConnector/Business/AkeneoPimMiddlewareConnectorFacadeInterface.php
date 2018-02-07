<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;

interface AkeneoPimMiddlewareConnectorFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getCategoryImportMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getCategoryImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductModelImportMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductModelImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getAttributeMapTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapPreparationMapperConfig(): MapperConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductPreparationTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductModelPreparationTranslatorConfig(): TranslatorConfigTransfer;
}
