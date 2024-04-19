<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
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
