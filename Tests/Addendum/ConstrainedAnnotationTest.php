<?php

namespace Tests\Addendum;

use Addendum\ReflectionAnnotatedClass;
require __DIR__ . '/Fixtures/ConstrainedAnnotationTestData.php';

/**
 * @runTestsInSeparateProcesses
 */
class ConstrainedAnnotationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PHPUnit_Framework_Error
     * @group failedTests
     */
    public function testClassAnnotationThrowsErrorWhenOnMethod()
    {
    //    $this->expectError("Annotation 'ClassRestrictedAnnotation' not allowed on BadlyAnnotatedClass::method");
        $reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass');
        $method = $reflection->getMethod('method');
    }
    
    /**
     * @expectedException PHPUnit_Framework_Error
     * @group failedTests
     */
    public function testClassAnnotationThrowsErrorWhenOnProperty()
    {
    //    $this->expectError("Annotation 'ClassRestrictedAnnotation' not allowed on BadlyAnnotatedClass::\$property");
        $reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass');
        $method = $reflection->getProperty('property');
    }

    public function testSingleTargetAnnotationThrowsNoErrorWhenOnRightPlace()
    {
        $reflection = new ReflectionAnnotatedClass('SuccesfullyAnnotatedClass');
        $method = $reflection->getMethod('method');
        $property = $reflection->getProperty('property');
    }

    
    /**
     * @expectedException PHPUnit_Framework_Error
     * @group failedTests
     */
    public function testMultiTargetAnnotationThrowsErrorWhenOnWrongPlace()
    {
    //    $this->expectError("Annotation 'ClassOrPropertyRestrictedAnnotation' not allowed on BadlyAnnotatedClass::method2");
        $reflection = new ReflectionAnnotatedClass('BadlyAnnotatedClass');
        $method = $reflection->getMethod('method2');
    }

    public function testMultiTargetAnnotationThrowsNoErrorWhenOnRightPlace()
    {
        $reflection = new ReflectionAnnotatedClass('SuccesfullyAnnotatedClass');
        $method = $reflection->getProperty('property2');
    }
    
    /**
     * @expectedException PHPUnit_Framework_Error
     * @group failedTests
     */
    public function testBadlyNestedAnnotationThrowsError()
    {
/*        $this->expectError("Annotation 'MethodRestrictedAnnotation' nesting not allowed");
        $this->expectError("Annotation 'MethodRestrictedAnnotation' nesting not allowed"); // because of parsing //*/
        $reflection = new ReflectionAnnotatedClass('ClassWithBadlyNestedAnnotations');
    }

    public function testSuccesfullyNestedAnnotationThrowsNoError()
    {
        $reflection = new ReflectionAnnotatedClass('SuccesfullyAnnotatedClass');
        $reflection->getMethod('method2')->getAnnotation('MethodRestrictedAnnotation');
    }
}
