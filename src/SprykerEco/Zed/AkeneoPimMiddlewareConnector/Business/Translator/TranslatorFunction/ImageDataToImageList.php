<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction;

use InvalidArgumentException;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\Image\ImageData;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\AbstractTranslatorFunction;
use SprykerMiddleware\Zed\Process\Business\Translator\TranslatorFunction\TranslatorFunctionInterface;

class ImageDataToImageList extends AbstractTranslatorFunction implements TranslatorFunctionInterface
{
    const KEY_LOCALE = 'locale';
    const KEY_DATA = 'data';

    const IMAGE_PARTS_DELIMITER = '/[\#]{3,}/';
    const IMAGE_LINE_DELIMITER = '/(' . PHP_EOL . '|,)/';

    /**
     * @param mixed $value
     * @param array $payload
     *
     * @return mixed
     */
    public function translate($value, array $payload): array
    {
        if (count($value) == 0) {
            return [];
        }

        $images = [];

        foreach ($value as $item) {
            $locale = $item[static::KEY_LOCALE];
            $imageData = $item[static::KEY_DATA];
            $images[$locale] = $this->parse($imageData);
        }

        return $images;
    }

    /**
     * @param string $data
     *
     * @return array
     */
    public function parse(string $data): array
    {
        $images = [];

        $lines = preg_split(static::IMAGE_LINE_DELIMITER, $data);

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            try {
                $images[] = $this->parseImageAttributeLine($line);
            } catch (InvalidArgumentException $exception) {
                //@todo maybe log this? Add dummy image?
            }
        }

        return $images;
    }

    /**
     * @param string $line
     *
     * @return \Pyz\Zed\Process\Business\Translator\TranslatorFunction\Image\ImageData
     */
    private function parseImageAttributeLine(string $line): ImageData
    {
        $parts = preg_split(static::IMAGE_PARTS_DELIMITER, $line);

        $imagePath = $parts[0] ?: '';
        $this->validateImageRelativePath($imagePath);

        $imageTitle = $parts[1] ?? '';
        $imageDescription = $parts[2] ?? '';

        $imageData = new ImageData(trim($imagePath), trim($imageTitle), trim($imageDescription));

        return $imageData;
    }

    /**
     * @param string $imagePath
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    private function validateImageRelativePath(string $imagePath): void
    {
        if (trim($imagePath) === '') {
            throw new InvalidArgumentException('Image relative path can\'t be empty');
        }
    }
}
