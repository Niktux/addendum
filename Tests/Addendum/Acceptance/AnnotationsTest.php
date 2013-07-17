<?php

namespace Tests\Addendum\Acceptance;

use Addendum\ReflectionAnnotatedClass;
use Addendum\ReflectionAnnotatedMethod;
use Addendum\ReflectionAnnotatedProperty;
use Addendum\AnnotationsBuilder;
use Addendum\Addendum;

use \ReflectionClass as ReflectionClass;
use \ReflectionMethod as ReflectionMethod;
use \ReflectionProperty as ReflectionProperty;

require_once __DIR__ . '/../Fixtures/AcceptanceTestData.php';

class AnnotationsTest extends \PHPUnit_Framework_TestCase
{
    public function testReflectionAnnotatedClass()
    {
        $reflection = new ReflectionAnnotatedClass('Example');
        $this->assertTrue($reflection->hasAnnotation('FirstAnnotation'));
        $this->assertTrue($reflection->hasAnnotation('SecondAnnotation'));
        $this->assertFalse($reflection->hasAnnotation('NonExistentAnnotation'));
        $this->assertInstanceOf('FirstAnnotation', $reflection->getAnnotation('FirstAnnotation'));
        $this->assertInstanceOf('SecondAnnotation', $reflection->getAnnotation('SecondAnnotation'));
            
        $annotations = $reflection->getAnnotations();
        $this->assertEquals(count($annotations), 2);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('SecondAnnotation', $annotations[1]);
        $this->assertFalse($reflection->getAnnotation('NonExistentAnnotation'));
            
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedMethod', $reflection->getConstructor());
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedMethod', $reflection->getMethod('exampleMethod'));
        foreach($reflection->getMethods() as $method)
        {
            $this->assertInstanceOf('Addendum\ReflectionAnnotatedMethod', $method);
        }
            
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedProperty', $reflection->getProperty('exampleProperty'));
        foreach($reflection->getProperties() as $property)
        {
            $this->assertInstanceOf('Addendum\ReflectionAnnotatedProperty', $property);
        }
            
        foreach($reflection->getInterfaces() as $interface) {
            $this->assertInstanceOf('Addendum\ReflectionAnnotatedClass', $interface);
        }
            
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedClass', $reflection->getParentClass());
    }

    public function testReflectionAnnotatedClassInterface()
    {
        $reflection = new ReflectionAnnotatedClass('ExampleInterface');
        $this->assertTrue($reflection->hasAnnotation('FirstAnnotation'));
        $this->assertTrue($reflection->hasAnnotation('SecondAnnotation'));
    }

    public function testReflectionAnnotatedMethod()
    {
        $reflection = new ReflectionAnnotatedMethod('Example', 'exampleMethod');
        $this->assertTrue($reflection->hasAnnotation('FirstAnnotation'));
        $this->assertFalse($reflection->hasAnnotation('NonExistentAnnotation'));
        $this->assertInstanceOf('FirstAnnotation', $reflection->getAnnotation('FirstAnnotation'));
        $this->assertFalse($reflection->getAnnotation('NonExistentAnnotation'));
            
        $annotations = $reflection->getAnnotations();
        $this->assertEquals(count($annotations), 1);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
            
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedClass', $reflection->getDeclaringClass());
    }

    public function testReflectionAnnotatedProperty()
    {
        $reflection = new ReflectionAnnotatedProperty('Example', 'exampleProperty');
        $this->assertTrue($reflection->hasAnnotation('SecondAnnotation'));
        $this->assertFalse($reflection->hasAnnotation('FirstAnnotation'));
        $this->assertInstanceOf('SecondAnnotation', $reflection->getAnnotation('SecondAnnotation'));
        $this->assertFalse($reflection->getAnnotation('NonExistentAnnotation'));
            
        $annotations = $reflection->getAnnotations();
        $this->assertEquals(count($annotations), 1);
        $this->assertInstanceOf('SecondAnnotation', $annotations[0]);
            
        $this->assertInstanceOf('Addendum\ReflectionAnnotatedClass', $reflection->getDeclaringClass());
    }

    public function testReflectionClassCanFilterMethodsByAccess()
    {
        $reflection = new ReflectionAnnotatedClass('Example');
        $privateMethods = $reflection->getMethods(ReflectionMethod::IS_PRIVATE);
        $this->assertEquals(count($privateMethods), 1);
        $this->assertEquals($privateMethods[0]->getName(), 'justPrivate');
    }

    public function testReflectionClassCanFilterPropertiesByAccess()
    {
        $reflection = new ReflectionAnnotatedClass('Example');
        $privateProperties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $this->assertEquals(count($privateProperties), 1);
        $this->assertEquals($privateProperties[0]->getName(), 'publicOne');
    }

    public function testReflectionClassShouldReturnAllMethodsWithNoFilter()
    {
        $reflection = new ReflectionAnnotatedClass('Example');
        $methods = $reflection->getMethods();
        $this->assertEquals(count($methods), 3);
    }

    public function testReflectionClassShouldReturnAllPropertiesWithNoFilter()
    {
        $reflection = new ReflectionAnnotatedClass('Example');
        $properties = $reflection->getProperties();
        $this->assertEquals(count($properties), 2);
    }

    public function testMultipleAnnotationsOnClass()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $annotations = $reflection->getAllAnnotations();
        $this->assertEquals(count($annotations), 3);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertEquals($annotations[2]->value, 3);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
        $this->assertInstanceOf('SecondAnnotation', $annotations[2]);
    }

    public function testMultipleAnnotationsOnClassWithRestriction()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $annotations = $reflection->getAllAnnotations('FirstAnnotation');
        $this->assertEquals(count($annotations), 2);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
    }

    public function testMultipleAnnotationsOnProperty()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $reflection = $reflection->getProperty('property');
        $annotations = $reflection->getAllAnnotations();
        $this->assertEquals(count($annotations), 3);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertEquals($annotations[2]->value, 3);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
        $this->assertInstanceOf('SecondAnnotation', $annotations[2]);
    }

    public function testMultipleAnnotationsOnPropertyWithRestriction()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $reflection = $reflection->getProperty('property');
        $annotations = $reflection->getAllAnnotations('FirstAnnotation');
        $this->assertEquals(count($annotations), 2);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
    }

    public function testMultipleAnnotationsOnMethod()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $reflection = $reflection->getMethod('aMethod');
        $annotations = $reflection->getAllAnnotations();
        $this->assertEquals(count($annotations), 3);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertEquals($annotations[2]->value, 3);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
        $this->assertInstanceOf('SecondAnnotation', $annotations[2]);
    }

    public function testMultipleAnnotationsOnMethodWithRestriction()
    {
        $reflection = new ReflectionAnnotatedClass('MultiExample');
        $reflection = $reflection->getMethod('aMethod');
        $annotations = $reflection->getAllAnnotations('FirstAnnotation');
        $this->assertEquals(count($annotations), 2);
        $this->assertEquals($annotations[0]->value, 1);
        $this->assertEquals($annotations[1]->value, 2);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
        $this->assertInstanceOf('FirstAnnotation', $annotations[1]);
    }

    public function testClassWithNoAnnotationParentShouldNotBeParsed()
    {
        $reflection = new ReflectionAnnotatedClass('ExampleWithInvalidAnnotation');
        $annotations = $reflection = $reflection->getAnnotations();
        $this->assertEquals(count($annotations), 1);
        $this->assertInstanceOf('FirstAnnotation', $annotations[0]);
    }

    /**
     * FIXME not equivalent :-(
     * @expectedException PHPUnit_Framework_Error
     */
    public function testCircularReferenceShouldThrowError()
    {
//        $this->expectError("Circular annotation reference on 'SelfReferencingAnnotation'");
        $reflection = new ReflectionAnnotatedClass('SelfReferencingAnnotation');
        $reflection->getAnnotations();

//        $this->expectError("Circular annotation reference on 'IndirectReferenceLoopAnnotationHelper'");
        $reflection = new ReflectionAnnotatedClass('IndirectReferenceLoopAnnotation');
        $reflection->getAnnotations();
    }

    public function testConstInAnnotationShouldReturnCorrectValue()
    {
        $reflection = new ReflectionAnnotatedClass('ClassAnnotatedWithStaticConstant');
        $annotation = $reflection->getAnnotation('FirstAnnotation');
        $this->assertEquals($annotation->value, \Statics::A_CONSTANT);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testBadConstInAnnotationShouldCauseError()
    {
//        $this->expectError("Constant 'Statics::UNKNOWN_CONSTANT' used in annotation was not defined.");
        $reflection = new ReflectionAnnotatedClass('ClassAnnotatedWithNonExistingConstant');
        $annotation = $reflection->getAnnotation('FirstAnnotation');
    }

    public function testNestedAnnotationSupport()
    {
        $reflection = new ReflectionAnnotatedClass('ClassAnnotatedWithNestedAnnotations');
        $this->assertEquals(count($reflection->getAnnotations()), 1);
        $annotation = $reflection->getAnnotation('FirstAnnotation');
        $this->assertInstanceOf('FirstAnnotation', $annotation);
        $this->assertInstanceOf('SecondAnnotation', $annotation->key);
        $this->assertEquals($annotation->key->value, 3.14);
    }

    public function testAnnotationWithoutNamespaceShouldBeRecognized()
    {
        $reflection = new ReflectionAnnotatedClass('ClassAnnotatedWithNamespacedAnnotation');
        $this->assertTrue($reflection->hasAnnotation('AnnotationWithNamespace'));
    }
}
