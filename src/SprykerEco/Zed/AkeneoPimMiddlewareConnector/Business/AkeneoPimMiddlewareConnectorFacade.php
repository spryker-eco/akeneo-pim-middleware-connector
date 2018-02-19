<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business;

use Generated\Shared\Transfer\MapperConfigTransfer;
use Generated\Shared\Transfer\TranslatorConfigTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorBusinessFactory getFactory()
 */
class AkeneoPimMiddlewareConnectorFacade extends AbstractFacade implements AkeneoPimMiddlewareConnectorFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getCategoryImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createCategoryImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getCategoryImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createCategoryImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getProductImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getProductModelImportMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createProductModelImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getProductModelImportTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createProductModelImportDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapImportMap()
            ->getMapperConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\TranslatorConfigTransfer;
     */
    public function getAttributeMapTranslatorConfig(): TranslatorConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapDictionary()
            ->getTranslatorConfig();
    }

    /**
     * @return \Generated\Shared\Transfer\MapperConfigTransfer
     */
    public function getAttributeMapPreparationMapperConfig(): MapperConfigTransfer
    {
        return $this->getFactory()
            ->createAttributeMapPreparationMap()
            ->getMapperConfig();
    }

    /**
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
}
