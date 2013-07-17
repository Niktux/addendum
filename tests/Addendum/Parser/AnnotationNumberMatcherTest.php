<?php

namespace Tests\Addendum\Parser;

class AnnotationNumberMatcher extends AnnotationMatcherTestCase
{
    /**
     * @group failedTests
     */
    public function testNumberMatcherShouldMatchInteger()
    {
        $matcher = new AnnotationNumberMatcher();
        $this->assertMatcherResult($matcher, '-314', -314);
    }
    
    /**
     * @group failedTests
     */
    public function testNumberMatcherShouldMatchFloat()
    {
        $matcher = new AnnotationNumberMatcher();
        $this->assertMatcherResult($matcher, '-3.14', -3.14);
    }
}