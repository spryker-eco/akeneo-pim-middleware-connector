<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\Generator;

use Orm\Zed\Locale\Persistence\SpyLocaleQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class UrlGeneratorStrategy implements UrlGeneratorStrategyInterface
{

    /**
     * @var int[] Keys are locale ids, values are locale names.
     */
    protected static $idLocaleBuffer;

    /**
     * @param string $name
     * @param int $idLocale
     * @param string $identifier
     *
     * @return string
     */
    public function generate(string $name, int $idLocale, string $identifier): string
    {
        $abstractProductUrl = $this->generateUrlSlug($name);
        $abstractProductUrl = '/' . $this->getLocaleNameById($idLocale) . '/' . $abstractProductUrl . '-' . md5($identifier);
        $this->cleanupRedirectUrls($abstractProductUrl);

        return $abstractProductUrl;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function generateUrlSlug($value): string
    {
        if (function_exists('iconv')) {
            $value = iconv('UTF-8', 'ASCII//TRANSLIT', $value);
        }

        $value = preg_replace("/[^a-zA-Z0-9 -]/", "", trim($value));
        $value = mb_strtolower($value);
        $value = str_replace(' ', '-', $value);
        $value = preg_replace('/(\-)\1+/', '$1', $value);

        return $value;
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
