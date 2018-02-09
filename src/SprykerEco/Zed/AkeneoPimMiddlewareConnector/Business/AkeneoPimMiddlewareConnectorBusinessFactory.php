<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\LocaleMapper;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\LocaleMapperInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\AttributeMapImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\AttributeMapPreparationMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\CategoryImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\ProductImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\ProductModelImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\TaxSetMapper;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\TaxSetMapperInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\AttributeMapDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\CategoryImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductModelImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductModelPreparationDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductPreparationDictionary;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConfig getConfig()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainerInterface getQueryContainer()
 */
class AkeneoPimMiddlewareConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createProductImportMap(): MapInterface
    {
        return new ProductImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createProductModelImportMap(): MapInterface
    {
        return new ProductModelImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createCategoryImportMap(): MapInterface
    {
        return new CategoryImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createAttributeMapImportMap(): MapInterface
    {
        return new AttributeMapImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createAttributeMapPreparationMap(): MapInterface
    {
        return new AttributeMapPreparationMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductModelImportDictionary(): DictionaryInterface
    {
        return new ProductModelImportDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductImportDictionary(): DictionaryInterface
    {
        return new ProductImportDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductModelPreparationDictionary(): DictionaryInterface
    {
        return new ProductModelPreparationDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductPreparationDictionary(): DictionaryInterface
    {
        return new ProductPreparationDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createCategoryImportDictionary(): DictionaryInterface
    {
        return new CategoryImportDictionary();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createAttributeMapDictionary(): DictionaryInterface
    {
        return new AttributeMapDictionary();
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\LocaleMapperInterface
     */
    public function createLocaleMapper(): LocaleMapperInterface
    {
        return new LocaleMapper();
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\TaxSetMapperInterface
     */
    public function createTaxSetMapper(): TaxSetMapperInterface
    {
        return new TaxSetMapper();
    }
}
