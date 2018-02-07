<?php

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Translator\TranslatorFunction\Image;

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

class ImageData
{
    /**
     * @var string
     */
    private $relativePath;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @param string $relativePath
     * @param string $title
     * @param string $description
     */
    public function __construct(string $relativePath, string $title, string $description)
    {
        $this->relativePath = $relativePath;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
