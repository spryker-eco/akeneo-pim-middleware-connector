<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;

interface AkeneoPimMiddlewareConnectorFacadeInterface
{
    /**
     * Specification:
     * - Gets mapper config for category import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getCategoryImportMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for category import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getCategoryImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets mapper config for product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets mapper config for abstract product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductModelImportMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for abstract product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getProductModelImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets mapper config for attribute map
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for attribute map
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getAttributeMapTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets mapper config for attribute map preparation
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapPreparationMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets mapper config for default category import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getDefaultCategoryImportMapperConfig(): MapperConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for default category import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultCategoryImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for default product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultProductImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets translator config for default abstract product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultProductModelImportTranslatorConfig(): TranslatorConfigTransfer;

    /**
     * Specification:
     * - Gets validator config for abstract product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductModelImportValidatorConfig(): ValidatorConfigTransfer;

    /**
     * Specification:
     * - Gets validator config for product import
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductImportValidatorConfig(): ValidatorConfigTransfer;

    /**
     * Specification:
     * - Maps locale payload
     *
     * @api
     *
     * @param array $payload
     *
     * @return array
     */
    public function mapLocalePayload(array $payload): array;

    /**
     * Specification:
     * - Maps tax set payload
     *
     * @api
     *
     * @param array $payload
     *
     * @return array
     */
    public function mapTaxSetPayload(array $payload): array;
}
