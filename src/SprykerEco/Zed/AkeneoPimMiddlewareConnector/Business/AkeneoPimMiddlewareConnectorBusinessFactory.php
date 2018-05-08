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
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\DefaultCategoryImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\ProductImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\Map\ProductModelImportMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\TaxSetMapper;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper\TaxSetMapperInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\AttributeMapDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\CategoryImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\DefaultCategoryImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\DefaultProductImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\DefaultProductModelImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Dictionary\ProductModelImportDictionary;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\ValidationRuleSet\ProductImportValidationRuleSet;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Validator\ValidationRuleSet\ProductModelImportValidationRuleSet;
use SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface;
use SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface;
use SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface;

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
        return new ProductModelImportMap($this->getConfig());
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
        return new ProductModelImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createProductImportDictionary(): DictionaryInterface
    {
        return new ProductImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createCategoryImportDictionary(): DictionaryInterface
    {
        return new CategoryImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createAttributeMapDictionary(): DictionaryInterface
    {
        return new AttributeMapDictionary($this->getConfig());
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

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Mapper\Map\MapInterface
     */
    public function createDefaultCategoryImportMap(): MapInterface
    {
        return new DefaultCategoryImportMap();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createDefaultProductModelImportDictionary(): DictionaryInterface
    {
        return new DefaultProductModelImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createDefaultProductImportDictionary(): DictionaryInterface
    {
        return new DefaultProductImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Translator\Dictionary\DictionaryInterface
     */
    public function createDefaultCategoryImportDictionary(): DictionaryInterface
    {
        return new DefaultCategoryImportDictionary($this->getConfig());
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface
     */
    public function createProductModelImportValidationRuleSet(): ValidationRuleSetInterface
    {
        return new ProductModelImportValidationRuleSet();
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Validator\ValidationRuleSet\ValidationRuleSetInterface
     */
    public function createProductImportValidationRuleSet(): ValidationRuleSetInterface
    {
        return new ProductImportValidationRuleSet($this->getConfig());
    }
}
