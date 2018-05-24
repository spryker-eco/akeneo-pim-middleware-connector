<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator;

interface UrlGeneratorStrategyInterface
{
    /**
     * @param string $name
     * @param int $idLocale
     * @param string $identifier
     *
     * @return string
     */
    public function generate(string $name, int $idLocale, string $identifier): string;
}
