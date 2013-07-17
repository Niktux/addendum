<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationMatcher;

class AnnotationMatcherTest extends AnnotationMatcherTestCase
{
    public function testAnnotationMatcherShouldMatchSimpleAnnotation()
    {
        $matcher = new AnnotationMatcher();
        $this->assertNotFalse($matcher->matches('@Namespace_Annotation', $value));
        $this->assertEquals($value, array('Namespace_Annotation', array()));
    }
    
    public function testAnnotationMatcherShouldNotMatchAnnotationWithSmallStartingLetter()
    {
        $matcher = new AnnotationMatcher();
        $this->assertFalse($matcher->matches('@annotation', $value));
    }
    
    public function testAnnotationMatcherShouldMatchShortAnnotations()
    {
        $matcher = new AnnotationMatcher();
        $this->assertMatcherResult($matcher, '@X', array('X', array()));
    }
    
    public function testAnnotationMatcherShouldMatchAlsoBrackets()
    {
        $matcher = new AnnotationMatcher();
        $this->assertEquals($matcher->matches('@Annotation()', $value), 13);
        $this->assertEquals($value, array('Annotation', array()));
    }
    
    public function testAnnotationMatcherShouldMatchValuedAnnotation()
    {
        $matcher = new AnnotationMatcher();
        $this->assertMatcherResult($matcher, '@Annotation(true)', array('Annotation', array('value' => true)));
    }
    
    public function testAnnotationMatcherShouldMatchMultiValuedAnnotation()
    {
        $matcher = new AnnotationMatcher();
        $this->assertMatcherResult($matcher, '@Annotation(key=true, key2=3.14)', array('Annotation', array('key' => true, 'key2' => 3.14)));
    }
}