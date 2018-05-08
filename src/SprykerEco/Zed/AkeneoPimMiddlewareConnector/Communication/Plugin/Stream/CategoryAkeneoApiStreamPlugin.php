<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface;

/**
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory getFactory()
 * @method \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\AkeneoPimMiddlewareConnectorFacadeInterface getFacade()
 */
class CategoryAkeneoApiStreamPlugin extends AbstractPlugin implements InputStreamPluginInterface
{
    protected const PLUGIN_NAME = 'CategoryAkeneoApiStreamPlugin';

    /**
     * @param string $path
     *
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    public function getInputStream(string $path): ReadStreamInterface
    {
        return $this->getFactory()
            ->createStreamFactory()
            ->createCategoryAkeneoApiReadStream();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::PLUGIN_NAME;
    }
}
