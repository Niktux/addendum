<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationKeyMatcher;

class AnnotationKeyMatcherTest extends AnnotationMatcherTestCase
{
    public function testKeyMatcherShouldMatchSimpleKeysOrStrings()
    {
        $matcher = new AnnotationKeyMatcher();
        $this->assertNotFalse($matcher->matches('key', $value));
        $this->assertNotFalse($matcher->matches('"key"', $value));
        $this->assertNotFalse($matcher->matches("'key'", $value));
    }
    
    public function testKeyMatcherShouldMatchIntegerKeys()
    {
        $matcher = new AnnotationKeyMatcher();
        $this->assertMatcherResult($matcher, '123', 123);
    }
}
