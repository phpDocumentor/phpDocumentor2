<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.3
 *
 * @copyright 2010-2018 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Descriptor;

use \Mockery as m;

/**
 * Tests the functionality for the FileDescriptor class.
 */
class FileDescriptorTest extends \Mockery\Adapter\Phpunit\MockeryTestCase
{
    const EXAMPLE_HASH = 'a-hash-string';

    const EXAMPLE_PATH = 'a-path-string';

    const EXAMPLE_SOURCE = 'a-source-string';

    /** @var FileDescriptor $fixture */
    protected $fixture;

    /**
     * Creates a new (empty) fixture object.
     */
    protected function setUp(): void
    {
        $this->fixture = new FileDescriptor(self::EXAMPLE_HASH);
    }

    /**
     * Tests whether all collection objects and hash are properly initialized
     *
     * @covers \phpDocumentor\Descriptor\FileDescriptor::__construct
     */
    public function testInitialize() : void
    {
        $this->assertAttributeEquals(self::EXAMPLE_HASH, 'hash', $this->fixture);

        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'namespaceAliases', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'includes', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'constants', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'functions', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'classes', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'interfaces', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'traits', $this->fixture);
        $this->assertAttributeInstanceOf('phpDocumentor\Descriptor\Collection', 'markers', $this->fixture);
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::__construct
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getHash
     */
    public function testGetHash() : void
    {
        $this->assertSame(self::EXAMPLE_HASH, $this->fixture->getHash());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setPath
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getPath
     */
    public function testSetAndGetPath() : void
    {
        $this->assertSame('', $this->fixture->getPath());

        $this->fixture->setPath(self::EXAMPLE_PATH);

        $this->assertSame(self::EXAMPLE_PATH, $this->fixture->getPath());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setSource
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getSource
     */
    public function testSetAndGetSource() : void
    {
        $this->assertNull($this->fixture->getSource());

        $this->fixture->setSource(self::EXAMPLE_SOURCE);

        $this->assertSame(self::EXAMPLE_SOURCE, $this->fixture->getSource());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setNamespaceAliases
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getNamespaceAliases
     */
    public function testSetAndGetNamespaceAliases() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getNamespaceAliases());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setNamespaceAliases($mock);

        $this->assertSame($mockInstance, $this->fixture->getNamespaceAliases());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setIncludes
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getIncludes
     */
    public function testSetAndGetIncludes() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getIncludes());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setIncludes($mock);

        $this->assertSame($mockInstance, $this->fixture->getIncludes());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setConstants
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getConstants
     */
    public function testSetAndGetConstants() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getConstants());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setConstants($mock);

        $this->assertSame($mockInstance, $this->fixture->getConstants());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setFunctions
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getFunctions
     */
    public function testSetAndGetFunctions() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getFunctions());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setFunctions($mock);

        $this->assertSame($mockInstance, $this->fixture->getFunctions());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setClasses
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getClasses
     */
    public function testSetAndGetClasses() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getClasses());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setClasses($mock);

        $this->assertSame($mockInstance, $this->fixture->getClasses());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setInterfaces
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getInterfaces
     */
    public function testSetAndGetInterfaces() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getInterfaces());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setInterfaces($mock);

        $this->assertSame($mockInstance, $this->fixture->getInterfaces());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setTraits
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getTraits
     */
    public function testSetAndGetTraits() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getTraits());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setTraits($mock);

        $this->assertSame($mockInstance, $this->fixture->getTraits());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::setMarkers
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getMarkers
     */
    public function testSetAndGetMarkers() : void
    {
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getMarkers());

        $mockInstance = m::mock('phpDocumentor\Descriptor\Collection');
        $mock = $mockInstance;

        $this->fixture->setMarkers($mock);

        $this->assertSame($mockInstance, $this->fixture->getMarkers());
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::__construct
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getAllErrors
     */
    public function testIfErrorsAreInitializedToAnEmptyCollectionOnInstantiation() : void
    {
        // construct
        $this->assertInstanceOf('phpDocumentor\Descriptor\Collection', $this->fixture->getAllErrors());

        // default returns empty array
        $this->assertObjectHasAttribute('items', $this->fixture->getAllErrors());

        $items = $this->fixture->getAllErrors()->getAll();
        $this->assertEmpty($items);
    }

    /**
     * @covers \phpDocumentor\Descriptor\FileDescriptor::__construct
     * @covers \phpDocumentor\Descriptor\FileDescriptor::getAllErrors
     */
    public function testGetAllErrors() : void
    {
        /*
         * constant
         * function
         * class
         *     property
         *     constant
         *     method
         * interface
         *     constant
         *     method
         * traits
         *     property
         *     method
         */

        // setup error list
        $errorGlobal = ['error-global'];
        $errorClasses = ['error-class'];
        $errorClassMethods = ['error-class-method'];
        $errorClassConstants = ['error-class-constant'];
        $errorClassProperties = ['error-class-property'];
        $errorInterfaces = ['error-interface'];
        $errorInterfacesConstants = ['error-interface-constant'];
        $errorInterfacesMethods = ['error-interface-method'];
        $errorTraits = ['error-traits'];
        $errorTraitsProperties = ['error-traits-property'];
        $errorTraitsMethods = ['error-traits-method'];
        $errorFunctions = ['error-functions'];

        // setup global check
        $collection = new Collection($errorGlobal);
        $this->fixture->setErrors($collection);

        // setup class-property check
        $mockClassProperties = m::mock('phpDocumentor\Descriptor\PropertyDescriptor');
        $mockClassProperties->shouldReceive('getErrors')->andReturn(new Collection($errorClassProperties));

        // setup class-constant check
        $mockClassConstants = m::mock('phpDocumentor\Descriptor\ConstantDescriptor');
        $mockClassConstants->shouldReceive('getErrors')->andReturn(new Collection($errorClassConstants));

        // setup class-method check
        $mockClassMethods = m::mock('phpDocumentor\Descriptor\MethodDescriptor');
        $mockClassMethods->shouldReceive('getErrors')->andReturn(new Collection($errorClassMethods));

        // setup class check
        $mockClasses = m::mock('phpDocumentor\Descriptor\ClassDescriptor');
        $mockClasses->shouldReceive('getProperties')->andReturn(new Collection([$mockClassProperties]));
        $mockClasses->shouldReceive('getConstants')->andReturn(new Collection([$mockClassConstants]));
        $mockClasses->shouldReceive('getMethods')->andReturn(new Collection([$mockClassMethods]));
        $mockClasses->shouldReceive('getErrors')->andReturn(new Collection($errorClasses));

        $this->fixture->getClasses()->set('my-test-class', $mockClasses);

        // setup interface-constant check
        $mockInterfaceConstants = m::mock('phpDocumentor\Descriptor\ConstantDescriptor');
        $mockInterfaceConstants->shouldReceive('getErrors')->andReturn(new Collection($errorInterfacesConstants));

        // setup interface-method check
        $mockInterfaceMethods = m::mock('phpDocumentor\Descriptor\MethodDescriptor');
        $mockInterfaceMethods->shouldReceive('getErrors')->andReturn(new Collection($errorInterfacesMethods));

        // setup interface check
        $mockInterfaces = m::mock('phpDocumentor\Descriptor\ClassDescriptor');
        $mockInterfaces->shouldReceive('getProperties')->andReturn([]);
        $mockInterfaces->shouldReceive('getConstants')->andReturn(new Collection([$mockInterfaceConstants]));
        $mockInterfaces->shouldReceive('getMethods')->andReturn(new Collection([$mockInterfaceMethods]));
        $mockInterfaces->shouldReceive('getErrors')->andReturn(new Collection($errorInterfaces));

        $this->fixture->getClasses()->set('my-test-interface', $mockInterfaces);

        // setup traits-constant check
        $mockTraitsProperties = m::mock('phpDocumentor\Descriptor\ConstantDescriptor');
        $mockTraitsProperties->shouldReceive('getErrors')->andReturn(new Collection($errorTraitsProperties));

        // setup traits-method check
        $mockTraitsMethods = m::mock('phpDocumentor\Descriptor\MethodDescriptor');
        $mockTraitsMethods->shouldReceive('getErrors')->andReturn(new Collection($errorTraitsMethods));

        // setup traits check
        $mockTraits = m::mock('phpDocumentor\Descriptor\ClassDescriptor');
        $mockTraits->shouldReceive('getConstants')->andReturn([]);
        $mockTraits->shouldReceive('getProperties')->andReturn(new Collection([$mockTraitsProperties]));
        $mockTraits->shouldReceive('getMethods')->andReturn(new Collection([$mockTraitsMethods]));
        $mockTraits->shouldReceive('getErrors')->andReturn(new Collection($errorTraits));

        $this->fixture->getClasses()->set('my-test-traits', $mockTraits);

        // setup functions check
        $mockFunctions = m::mock('phpDocumentor\Descriptor\FunctionDescriptor');

        // create dummy instances of constants/methods
        $mockFunctions->shouldReceive('getConstants')->andReturn([]);
        $mockFunctions->shouldReceive('getProperties')->andReturn([]);
        $mockFunctions->shouldReceive('getMethods')->andReturn([]);
        $mockFunctions->shouldReceive('getErrors')->andReturn(new Collection($errorFunctions));

        $this->fixture->getClasses()->set('my-test-function', $mockFunctions);

        // final merge and check
        $expectedErrors = array_merge(
            $errorGlobal,
            $errorClasses,
            $errorInterfaces,
            $errorTraits,
            $errorFunctions,
            $errorClassMethods,
            $errorClassConstants,
            $errorClassProperties,
            $errorInterfacesMethods,
            $errorInterfacesConstants,
            $errorTraitsMethods,
            $errorTraitsProperties
        );

        $this->assertSame($expectedErrors, $this->fixture->getAllErrors()->getAll());
    }
}
