<?php

namespace Tests\Addendum;

require_once __DIR__ . '/Fixtures/AnnotationTestData.php';

class AnnotationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorShouldNotFailOnNoValues()
    {
        $annotation = new \TestingAnnotation();
    }

    public function testConstructorShouldNotFailOnNoTarget()
    {
        $annotation = new \TestingAnnotation(array());
    }

    public function testConstructorsFillsParameters()
    {
        $annotation = new \TestingAnnotation(array('optional' => 1, 'required' => 2));
        
        $this->assertEquals($annotation->optional, 1);
        $this->assertEquals($annotation->required, 2);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testConstructorThrowsErrorOnInvalidParameter()
    {
        //$this->expectOutputString("Property 'unknown' not defined for annotation 'TestingAnnotation'");
        $annotation = new \TestingAnnotation(array('unknown' => 1), $this);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function TODO_testConstructorThrowsErrorWithoutSpecifingRequiredParameters()
    {
        //$this->expectOutputString("Property 'required' in annotation 'TestingAnnotation' is required");
        $annotation = new \TestingAnnotation();
    }
}