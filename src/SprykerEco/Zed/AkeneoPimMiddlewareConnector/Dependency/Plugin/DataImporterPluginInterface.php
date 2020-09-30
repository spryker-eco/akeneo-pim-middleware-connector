<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin;

interface DataImporterPluginInterface
{
    /**
     * @api
     *
     * @param array $data
     *
     * @return void
     */
    public function import(array $data): void;
}
