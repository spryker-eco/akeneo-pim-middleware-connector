<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Mapper;

class LocaleMapper implements LocaleMapperInterface
{
    protected const KEY_COLUMN_LOCALE_NAME = 'spy_locale.locale_name';
    protected const KEY_COLUMN_LOCALE_ID = 'spy_locale.id_locale';

    /**
     * @param array $payload
     *
     * @return array
     */
    public function map(array $payload): array
    {
        return [
            $payload[static::KEY_COLUMN_LOCALE_NAME] => $payload[static::KEY_COLUMN_LOCALE_ID],
        ];
    }
}
