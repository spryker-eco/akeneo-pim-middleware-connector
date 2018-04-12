<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

use SprykerEco\Shared\AkeneoPimMiddlewareConnector\AkeneoPimMiddlewareConnectorConstants;

$config[AkeneoPimMiddlewareConnectorConstants::SUPER_ATTRIBUTE_MAP_FILE_PATH] = '';
$config[AkeneoPimMiddlewareConnectorConstants::LOCALE_MAP_FILE_PATH] = '';
$config[AkeneoPimMiddlewareConnectorConstants::ATTRIBUTE_MAP_FILE_PATH] = '';
$config[AkeneoPimMiddlewareConnectorConstants::DEFAULT_FK_CATEGORY_TEMPLATE] = 1;
$config[AkeneoPimMiddlewareConnectorConstants::DEFAULT_TAX_SET] = 'taxSetName';
$config[AkeneoPimMiddlewareConnectorConstants::LOCALES_FOR_IMPORT] = [
    'de_DE',
    'de_AT',
];
$config[AkeneoPimMiddlewareConnectorConstants::DEFAULT_STORES_FOR_PRODUCTS] = [
    'DE',
    'AT',
];
