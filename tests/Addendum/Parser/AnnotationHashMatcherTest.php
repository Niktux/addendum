<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationHashMatcher;

class AnnotationHashMatcherTest extends AnnotationMatcherTestCase
{
    public function testHashMatcherShouldMatchSimpleHash()
    {
        $matcher = new AnnotationHashMatcher();
        $this->assertMatcherResult($matcher, 'key=true', array('key' => true));
    }
    
    public function testHashMatcherShouldMatchAlsoMultipleKeys()
    {
        $matcher = new AnnotationHashMatcher();
        $this->assertMatcherResult($matcher, 'key=true,key2=false', array('key' => true, 'key2' => false));
    }
    
    public function testHashMatcherShouldMatchAlsoMultipleKeysWithWhiteSpace()
    {
        $matcher = new AnnotationHashMatcher();
        $this->assertMatcherResult($matcher, "key=true\n\t\r ,\n\t\r key2=false", array('key' => true, 'key2' => false));
    }
}