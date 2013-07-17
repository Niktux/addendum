<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationPairMatcher;

class AnnotationPairMatcherTest extends AnnotationMatcherTestCase
{
    public function testPairMatcherShouldMatchNumericKey()
    {
        $matcher = new AnnotationPairMatcher();
        $this->assertMatcherResult($matcher, '2 = true', array(2 => true));
    }
    
    public function testPairMatcherShouldMatchAlsoWhitespace()
    {
        $matcher = new AnnotationPairMatcher();
        $this->assertMatcherResult($matcher, 'key = true', array('key' => true));
    }
}