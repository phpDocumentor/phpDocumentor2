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

namespace phpDocumentor\Descriptor;

use phpDocumentor\Descriptor\DocBlock\DescriptionDescriptor;
use phpDocumentor\Descriptor\Interfaces\PackageInterface;
use phpDocumentor\Descriptor\ProjectDescriptor\Settings;
use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\Fqsen;
use function current;

/**
 * Represents the entire project with its files, namespaces and indexes.
 *
 * @api
 * @package phpDocumentor\AST
 */
class ProjectDescriptor implements Interfaces\ProjectInterface, Descriptor
{
    /** @var string $name */
    private $name = '';

    /** @var Settings $settings */
    private $settings;

    /** @var Collection<string> $partials */
    private $partials;

    /** @var Collection<VersionDescriptor> $versions */
    private $versions;

    /** @var DescriptionDescriptor */
    private $description;

    /**
     * Initializes this descriptor.
     */
    public function __construct(string $name)
    {
        $this->setName($name);
        $this->setSettings(new Settings());
        $this->setPartials(new Collection());
        $this->versions = Collection::fromClassString(VersionDescriptor::class);

        $this->description = new DescriptionDescriptor(new Description(''), []);
    }

    /**
     * Sets the name for this project.
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    /**
     * Returns the name of this project.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the description for this element.
     */
    public function getDescription() : DescriptionDescriptor
    {
        return $this->description;
    }

    /**
     * Sets the settings used to build the documentation for this project.
     */
    public function setSettings(Settings $settings) : void
    {
        $this->settings = $settings;
    }

    /**
     * Returns the settings used to build the documentation for this project.
     */
    public function getSettings() : Settings
    {
        return $this->settings;
    }

    /**
     * Sets all partials that can be used in a template.
     *
     * Partials are blocks of text that can be inserted anywhere in a template using a special indicator. An example is
     * the introduction partial that can add a custom piece of text to the homepage.
     *
     * @param Collection<string> $partials
     */
    public function setPartials(Collection $partials) : void
    {
        $this->partials = $partials;
    }

    /**
     * Returns a list of all partials.
     *
     * @see setPartials() for more information on partials.
     *
     * @return Collection<string>
     */
    public function getPartials() : Collection
    {
        return $this->partials;
    }

    /**
     * @return Collection<VersionDescriptor>
     */
    public function getVersions() : Collection
    {
        return $this->versions;
    }
}
