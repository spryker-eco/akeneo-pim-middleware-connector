<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
