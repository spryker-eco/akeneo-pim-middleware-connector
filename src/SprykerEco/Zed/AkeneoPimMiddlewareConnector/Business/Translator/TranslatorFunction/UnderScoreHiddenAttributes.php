<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class UnderScoreHiddenAttributes extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const PREFIX = '_';
    const KEY_GROUP = 'group';
    const GROUP_HIDDEN = 'hidden';

    /**
     * @var array
     */
    protected static $hiddenAttributeMap;

    /**
     * @var array
     */
    protected $requiredOptions = [
        'map',
    ];

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload)
    {
        if ($value === null) {
            return $value;
        }

        $hiddenAttributeGroupMap = $this->getHiddenAttribtueList();

        foreach ($value as $key => $attribute) {
            if (array_key_exists($key, $hiddenAttributeGroupMap)) {
                $value[static::PREFIX . $key] = $attribute;
                unset($value[$key]);
            }
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return $this->options['map'];
    }

    /**
     * @return array
     */
    protected function getHiddenAttribtueList(): array
    {
        if (static::$hiddenAttributeMap === null) {
            static::$hiddenAttributeMap = array_filter(
                array_map(function ($element) {
                    if (!array_key_exists(static::KEY_GROUP, $element)) {
                        return false;
                    }

                    if ($element[static::KEY_GROUP] === static::GROUP_HIDDEN) {
                        return true;
                    }

                    return false;
                }, $this->getMap())
            );
        }

        return static::$hiddenAttributeMap;
    }
}
