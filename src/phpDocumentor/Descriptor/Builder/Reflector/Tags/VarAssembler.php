<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link http://phpdoc.org
 */

namespace phpDocumentor\Descriptor\Builder\Reflector\Tags;

use phpDocumentor\Descriptor\Builder\Reflector\AssemblerAbstract;
use phpDocumentor\Descriptor\Tag\VarDescriptor;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

/**
 * Constructs a new descriptor from the Reflector for an `@var` tag.
 *
 * This object will read the reflected information for the `@var` tag and create a {@see VarDescriptor} object that
 * can be used in the rest of the application and templates.
 */
class VarAssembler extends AssemblerAbstract
{
    /**
     * Creates a new Descriptor from the given Reflector.
     *
     * @param Var_ $data
     */
    public function create(object $data) : VarDescriptor
    {
        $descriptor = new VarDescriptor($data->getName());
        $descriptor->setDescription((string) $data->getDescription());
        $descriptor->setVariableName($data->getVariableName());

        $descriptor->setType(AssemblerAbstract::deduplicateTypes($data->getType()));

        return $descriptor;
    }
}
