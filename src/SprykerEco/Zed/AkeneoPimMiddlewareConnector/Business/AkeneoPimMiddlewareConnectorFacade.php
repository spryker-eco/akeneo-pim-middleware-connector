<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Generated\Shared\Transfer\ValidatorConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorBusinessFactory getFactory()
 */
class AkeneoPimMiddlewareConnectorFacade extends AbstractFacade implements AkeneoPimMiddlewareConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getCategoryImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createCategoryImportMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getCategoryImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createCategoryImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductModelImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductModelImportMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getProductModelImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductModelImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapImportMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getAttributeMapTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapPreparationMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapPreparationMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $payload
     *
     * @return array
     */
    public function mapLocalePayload(array $payload): array
    {
        return $this->getFactory()
            ->createLocaleMapper()
            ->map($payload);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $payload
     *
     * @return array
     */
    public function mapTaxSetPayload(array $payload): array
    {
        return $this->getFactory()
            ->createTaxSetMapper()
            ->map($payload);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getDefaultCategoryImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createDefaultCategoryImportMap()
            ->getMapperConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultCategoryImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createDefaultCategoryImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultProductImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createDefaultProductImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer
     */
    public function getDefaultProductModelImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createDefaultProductModelImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductModelImportValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductModelImportValidationRuleSet()
            ->getValidatorConfig();
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return \Generated\Shared\Transfer\ValidatorConfigTransfer
     */
    public function getProductImportValidatorConfig(): ValidatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportValidationRuleSet()
            ->getValidatorConfig();
    }
}
