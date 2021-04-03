<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://phpdoc.org
 */

namespace phpDocumentor\FlowService\Guide;

use InvalidArgumentException;
use League\Tactician\CommandBus;
use phpDocumentor\Descriptor\DocumentationSetDescriptor;
use phpDocumentor\Descriptor\GuideSetDescriptor;
use phpDocumentor\FileSystem\FlySystemFactory;
use phpDocumentor\FlowService\Parser as ParserInterface;
use phpDocumentor\Guides\Configuration;
use phpDocumentor\Guides\Formats\Format;
use phpDocumentor\Guides\RestructuredText\ParseDirectoryCommand;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

final class Parser implements ParserInterface
{
    /** @var CommandBus */
    private $commandBus;

    /** @var LoggerInterface */
    private $logger;

    /** @var iterable<Format> */
    private $outputFormats;

    /** @var FlySystemFactory */
    private $flySystemFactory;

    /**
     * @param iterable<Format> $outputFormats
     */
    public function __construct(
        CommandBus $commandBus,
        LoggerInterface $logger,
        FlySystemFactory $flySystemFactory,
        iterable $outputFormats
    ) {
        $this->commandBus = $commandBus;
        $this->logger = $logger;
        $this->outputFormats = $outputFormats;
        $this->flySystemFactory = $flySystemFactory;
    }

    public function operate(DocumentationSetDescriptor $documentationSet) : void
    {
        if (!$documentationSet instanceof GuideSetDescriptor) {
            throw new InvalidArgumentException('Invalid documentation set');
        }

        $this->log('Parsing guides', LogLevel::NOTICE);

        $source = $documentationSet->getSource();
        $origin = $this->flySystemFactory->create($documentationSet->getSource()->dsn());
        $directory = $source['paths'][0] ?? '';
        $inputFormat = $documentationSet->getInputFormat();

        $configuration = new Configuration($inputFormat, $this->outputFormats);
        $configuration->setOutputFolder($documentationSet->getOutput());

        $this->commandBus->handle(new ParseDirectoryCommand($configuration, $origin, (string) $directory));
    }

    /**
     * Dispatches a logging request.
     *
     * @param string $priority The logging priority as declared in the LogLevel PSR-3 class.
     * @param string[] $parameters
     */
    private function log(string $message, string $priority = LogLevel::INFO, array $parameters = []) : void
    {
        $this->logger->log($priority, $message, $parameters);
    }
}
