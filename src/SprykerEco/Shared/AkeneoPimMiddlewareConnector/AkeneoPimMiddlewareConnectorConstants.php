<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\AkeneoPimMiddlewareConnector;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface AkeneoPimMiddlewareConnectorConstants
{
    /**
     * @var string
     */
    public const LOCALE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALE_MAP_FILE_PATH';

    /**
     * @var string
     */
    public const ATTRIBUTE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:ATTRIBUTE_MAP_FILE_PATH';

    /**
     * @var string
     */
    public const SUPER_ATTRIBUTE_MAP_FILE_PATH = 'AKENEOPIMMIDDLEWARECONNECTOR:SUPER_ATTRIBUTE_MAP_FILE_PATH';

    /**
     * @var string
     */
    public const FK_CATEGORY_TEMPLATE = 'AKENEOPIMMIDDLEWARECONNECTOR:FK_CATEGORY_TEMPLATE';

    /**
     * @var string
     */
    public const TAX_SET = 'AKENEOPIMMIDDLEWARECONNECTOR:TAX_SET';

    /**
     * @var string
     */
    public const LOCALES_FOR_IMPORT = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALES_FOR_IMPORT';

    /**
     * @var string
     */
    public const LOCALES_TO_PRICE_MAP = 'AKENEOPIMMIDDLEWARECONNECTOR:LOCALES_TO_PRICE_MAP';

    /**
     * @var string
     */
    public const ACTIVE_STORES_FOR_PRODUCTS = 'AKENEOPIMMIDDLEWARECONNECTOR:ACTIVE_STORES_FOR_PRODUCTS';

    /**
     * @var string
     */
    public const DEFAULT_PARENT_CATEGORY_KEY = 'AKENEOPIMMIDDLEWARECONNECTOR:DEFAULT_PARENT_CATEGORY_KEY';
}
