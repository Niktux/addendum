<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationMatcher;
use Addendum\Parser\AnnotationValueMatcher;

require_once __DIR__ . '/AnnotationMatchersTestData.php';

class AnnotationValueMatcherTest extends AnnotationMatcherTestCase
{
    public function testValueMatcherShouldMatchConstants()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertMatcherResult($matcher, 'true', true);
        $this->assertMatcherResult($matcher, 'false', false);
        $this->assertMatcherResult($matcher, 'TRUE', true);
        $this->assertMatcherResult($matcher, 'FALSE', false);
        $this->assertMatcherResult($matcher, 'NULL', null);
        $this->assertMatcherResult($matcher, 'null', null);
    }
    
    public function testValueMatcherShouldMatchStrings()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertMatcherResult($matcher, '"string"', 'string');
        $this->assertMatcherResult($matcher, "'string'", 'string');
    }
    
    public function testValueMatcherShouldMatchNumbers()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertMatcherResult($matcher, '-3.14', -3.14);
        $this->assertMatcherResult($matcher, '100', 100);
    }
    
    public function testValueMatcherShouldMatchArray()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertMatcherResult($matcher, '{1}', array(1));
    }
    
    public function testValueMatcherShouldMatchStaticConstant()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertMatcherResult($matcher, 'StaticClass::A_CONSTANT', \StaticClass::A_CONSTANT);
    }
    
    public function testValueMatcherShouldMatchAnnotation()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertNotSame($matcher->matches('@Annotation(true))', $value), false);
        $this->assertInstanceOf('Addendum\Annotation', $value);
        $this->assertTrue($value->value);
    }
    
    public function testNestedAnnotationMatcherShouldMatchAnnotation()
    {
        $matcher = new AnnotationValueMatcher();
        $this->assertNotSame($matcher->matches('@Annotation(true))', $value), false);
        $this->assertInstanceOf('Addendum\Annotation', $value);
        $this->assertTrue($value->value);
    }
}