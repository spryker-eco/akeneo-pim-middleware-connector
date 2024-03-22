<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\Helper;

use Codeception\Module;
use Codeception\Stub;
use Codeception\Stub\ConsecutiveMap;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactoryInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\Plugin\Stream\SuperAttributesAkeneoApiStreamPlugin;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceBridge;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface;
use SprykerEco\Zed\AkeneoPimMiddlewareConnector\Persistence\AkeneoPimMiddlewareConnectorQueryContainer;
use SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\AkeneoResourceCursorStub\FamilyResourceCursorStub;
use SprykerEcoTest\Zed\AkeneoPimMiddlewareConnector\AkeneoResourceCursorStub\FamilyVariantsResourceCursorStub;
use SprykerMiddleware\Service\Process\ProcessService;
use SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface;
use SprykerMiddleware\Zed\Process\Business\Iterator\IteratorInterface;
use SprykerMiddleware\Zed\Process\Business\Iterator\NullIterator;

class SuperAttributeAkeneoApiStreamPluginHelper extends Module
{
    /**
     * @var string
     */
    protected const FAMILY_1_VARIANT_1 = 'family_1_variant_1';

    /**
     * @var string
     */
    protected const FAMILY_2_VARIANT_1 = 'family_2_variant_1';

    /**
     * @var string
     */
    protected const FAMILY_2_VARIANT_2 = 'family_2_variant_2';

    /**
     * @return array<string>
     */
    public function getExpectedVariantCodes(): array
    {
        return [
            static::FAMILY_1_VARIANT_1,
            static::FAMILY_2_VARIANT_1,
            static::FAMILY_2_VARIANT_2,
        ];
    }

    /**
     * @return array
     */
    public function processSuperAttributesAkeneoReadPlugin(): array
    {
        $iterator = $this->createSuperAttributesAkeneoIterator();
        $processService = new ProcessService();

        $variantCodes = [];
        foreach ($iterator as $streamItem) {
            $variantItem = $processService->read($streamItem);
            $variantCodes[] = $variantItem['code'];
        }

        return $variantCodes;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Business\Iterator\IteratorInterface
     */
    protected function createSuperAttributesAkeneoIterator(): IteratorInterface
    {
        return new NullIterator($this->getSuperAttributeAkeneoReadStream());
    }

    /**
     * @return \SprykerMiddleware\Shared\Process\Stream\ReadStreamInterface
     */
    protected function getSuperAttributeAkeneoReadStream(): ReadStreamInterface
    {
        $streamPlugin = $this->getSuperAttributesAkeneoReadStreamPlugin();
        $stream = $streamPlugin->getInputStream('');
        $stream->open();

        return $stream;
    }

    /**
     * @return \SprykerMiddleware\Zed\Process\Dependency\Plugin\Stream\InputStreamPluginInterface|object
     */
    protected function getSuperAttributesAkeneoReadStreamPlugin()
    {
        $akeneoPimServiceMock = $this->getAkeneoPimServiceMock();
        $streamFactory = $this->createStreamFactory($akeneoPimServiceMock);
        $communicationFactoryMock = $this->getCommunicationFactoryMock($streamFactory);

        return Stub::make(SuperAttributesAkeneoApiStreamPlugin::class, [
            'getFactory' => $communicationFactoryMock,
        ]);
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface|object
     */
    protected function getAkeneoPimServiceMock()
    {
        return Stub::make(AkeneoPimMiddlewareConnectorToAkeneoPimServiceBridge::class, [
            'getAllFamilies' => new FamilyResourceCursorStub([
                ['code' => 'family_1'],
                ['code' => 'family_2'],
            ]),
            'getFamilyVariants' => new ConsecutiveMap([
                new FamilyVariantsResourceCursorStub([
                    $this->createFamilyVariantsResourceCursorOptions(static::FAMILY_1_VARIANT_1),
                ]),
                new FamilyVariantsResourceCursorStub([
                    $this->createFamilyVariantsResourceCursorOptions(static::FAMILY_2_VARIANT_1),
                    $this->createFamilyVariantsResourceCursorOptions(static::FAMILY_2_VARIANT_2),
                ]),
            ]),
        ]);
    }

    /**
     * @param string $familyVariantCode
     *
     * @return array
     */
    protected function createFamilyVariantsResourceCursorOptions(string $familyVariantCode): array
    {
        return [
            'code' => $familyVariantCode,
            'variant_attribute_sets' => [
                'level' => 1,
                'attributes' => [],
                'axes' => [],
            ],
        ];
    }

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Service\AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService
     *
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactoryInterface
     */
    protected function createStreamFactory(AkeneoPimMiddlewareConnectorToAkeneoPimServiceInterface $akeneoPimService): StreamFactoryInterface
    {
        $importerPluginMock = $this->getImporterPluginMock();

        $streamFactory = new StreamFactory(
            $akeneoPimService,
            new AkeneoPimMiddlewareConnectorQueryContainer(),
            $importerPluginMock,
            $importerPluginMock,
            $importerPluginMock,
            $importerPluginMock,
            $importerPluginMock,
            $importerPluginMock,
        );

        return $streamFactory;
    }

    /**
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Dependency\Plugin\DataImporterPluginInterface|object
     */
    protected function getImporterPluginMock()
    {
        return Stub::makeEmpty(DataImporterPluginInterface::class);
    }

    /**
     * @param \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Business\Stream\StreamFactoryInterface $streamFactory
     *
     * @return \SprykerEco\Zed\AkeneoPimMiddlewareConnector\Communication\AkeneoPimMiddlewareConnectorCommunicationFactory|object
     */
    protected function getCommunicationFactoryMock(StreamFactoryInterface $streamFactory): AkeneoPimMiddlewareConnectorCommunicationFactory
    {
        return Stub::make(AkeneoPimMiddlewareConnectorCommunicationFactory::class, [
            'createStreamFactory' => $streamFactory,
        ]);
    }
}
