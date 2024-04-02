<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface;

class UrlGeneratorStrategy implements UrlGeneratorStrategyInterface
{
    /**
     * @var array<int> Keys are locale ids, values are locale names.
     */
    protected static $idLocaleBuffer;

    /**
     * @var \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface
     */
    protected $utilTextService;

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Facade\AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface $textService
     */
    public function __construct(AkeneoPimMiddlewareConnectorToUtilTextBridgeInterface $textService)
    {
        $this->utilTextService = $textService;
    }

    /**
     * @param string $name
     * @param int $idLocale
     * @param string $identifier
     *
     * @return string
     */
    public function generate(string $name, int $idLocale, string $identifier): string
    {
        $abstractProductUrl = $this->utilTextService->generateSlug($name);
        $abstractProductUrl = '/' . substr($this->getLocaleNameById($idLocale), 0, 2) . '/' . $abstractProductUrl . '-' . md5($identifier);
        $this->cleanupRedirectUrls($abstractProductUrl);

        return $abstractProductUrl;
    }

    /**
     * @param int $localeId
     *
     * @return int
     */
    protected function getLocaleNameById($localeId)
    {
        if (!isset(static::$idLocaleBuffer[$localeId])) {
            static::$idLocaleBuffer[$localeId] =
                mb_strtolower(SpyLocaleQuery::create()->findOneByIdLocale($localeId)->getLocaleName());
        }

        return static::$idLocaleBuffer[$localeId];
    }

    /**
     * @param string $abstractProductUrl
     *
     * @return void
     */
    protected function cleanupRedirectUrls($abstractProductUrl)
    {
        SpyUrlQuery::create()
            ->filterByUrl($abstractProductUrl)
            ->filterByFkResourceRedirect(null, Criteria::ISNOTNULL)
            ->delete();
    }
}
