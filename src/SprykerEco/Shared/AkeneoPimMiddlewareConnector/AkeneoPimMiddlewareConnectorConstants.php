<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Shared\AkeneoPimMiddlewareConnector;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface AkeneoPimMiddlewareConnectorConstants
{
    public const LOCALE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALE_MAP_FILE_PATH';
    public const ATTRIBUTE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:ATTRIBUTE_MAP_FILE_PATH';
    public const SUPER_ATTRIBUTE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:SUPER_ATTRIBUTE_MAP_FILE_PATH';
    public const FK_CATEGORY_TEMPLATE = 'AKENEOPIMMIDDLEWARECONNECTOR:FK_CATEGORY_TEMPLATE';
    public const TAX_SET = 'AKENEOPIMMIDDLEWARECONNECTOR:TAX_SET';
    public const LOCALES_FOR_IMPORT = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALES_FOR_IMPORT';
    public const LOCALES_TO_PRICE_MAP = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALES_TO_PRICE_MAP';
    public const ACTIVE_STORES_FOR_PRODUCTS = 'AKENEOPIMMIDDLEWARECONNECTOR:ACTIVE_STORES_FOR_PRODUCTS';
}
