<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationMatcher;
use Addendum\Parser\AnnotationArrayMatcher;

class AnnotationArrayMatcherTest extends AnnotationMatcherTestCase
{
    public function testArrayMatcherShouldMatchEmptyArray()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{}', array());
    }
    
    public function testArrayMatcherShouldMatchSimpleValueInArray()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{1}', array(1));
    }
    
    public function testArrayMatcherShouldMatchSimplePair()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{key=5}', array('key' => 5));
    }
    
    public function TODO_testArrayMatcherShouldMatchPairWithNumericKeys()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{1="one", 2="two"}', array(1 => 'one', 2 => 'two'));
    }
    
    public function testArrayMatcherShouldMatchMultiplePairs()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{key=5, "bla"=false}', array('key' => 5, 'bla' => false));
    }
    
    public function testArrayMatcherShouldMatchValuesMixedWithPairs()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, '{key=5, 1, 2, key2="ff"}', array('key' => 5, 1, 2, 'key2' => "ff"));
    }
    
    public function testArrayMatcherShouldMatchMoreValuesInArrayWithWhiteSpace()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, "{1 , 2}", array(1, 2));
    }
    
    public function testArrayMatcherShouldMatchNestedArray()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, "{1 , {2, 3}, 4}", array(1, array(2, 3), 4));
    }
    
    public function testArrayMatcherShouldMatchWithMoreWhiteSpace()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, "{ 1 , 2 , 3 }", array(1, 2, 3));
    }
    
    public function testArrayMatcherShouldMatchWithMultilineWhiteSpace()
    {
        $matcher = new AnnotationArrayMatcher();
        $this->assertMatcherResult($matcher, "\n{1, 2, 3\n}", array(1, 2, 3));
    }
}