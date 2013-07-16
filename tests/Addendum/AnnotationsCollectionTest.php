<?php

namespace Tests\Addendum;

use Addendum\AnnotationsCollection;

require_once __DIR__ . '/Fixtures/AnnotationTestData.php';

class TestOfAnnotationCollection extends \PHPUnit_Framework_TestCase
{
    private
        $annotations;

    public function setUp()
    {
        $this->annotations = new AnnotationsCollection(array(
            'Annotation1' => array(new \Annotation1(array('value' => false)), new \Annotation1(array('value' => true))),
            'Annotation2' => array(new \Annotation2),
            'Namespace_Annotation3' => array(new \Namespace_Annotation3)
        ));
    }

    public function testHasAnnotation()
    {
        $this->assertTrue($this->annotations->hasAnnotation('Annotation1'));
        $this->assertFalse($this->annotations->hasAnnotation('Bad'));
        $this->assertTrue($this->annotations->hasAnnotation('Annotation3'));
    }
    
    public function testGetAnnotation()
    {
        $this->assertInstanceOf('Namespace_Annotation3', $this->annotations->getAnnotation('Annotation3'));
        $this->assertFalse($this->annotations->getAnnotation('Bad'));
    }
    
    public function testGetAnnotations()
    {
        $annotations = $this->annotations->getAnnotations();
        $this->assertEquals(count($annotations), 3);
        $this->assertTrue($annotations[0]->value);
    }
    
    public function testGetAllAnnotations()
    {
        $this->assertEquals(count($this->annotations->getAllAnnotations()), 4);
        $this->assertEquals(count($this->annotations->getAllAnnotations('Annotation1')), 2);
        $this->assertEquals(count($this->annotations->getAllAnnotations('Annotation3')), 1);
        $this->assertEquals(count($this->annotations->getAllAnnotations('Bad')), 0);
    }
}
