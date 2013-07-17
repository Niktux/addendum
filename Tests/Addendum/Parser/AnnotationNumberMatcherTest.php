<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationNumberMatcher;

class AnnotationNumberMatcherTest extends AnnotationMatcherTestCase
{
    public function testNumberMatcherShouldMatchInteger()
    {
        $matcher = new AnnotationNumberMatcher();
        $this->assertMatcherResult($matcher, '-314', -314);
    }
    
    public function testNumberMatcherShouldMatchFloat()
    {
        $matcher = new AnnotationNumberMatcher();
        $this->assertMatcherResult($matcher, '-3.14', -3.14);
    }
}