<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationStringMatcher;

class AnnotationStringMatcherTest extends AnnotationMatcherTestCase
{
    public function testStringMatcherShouldMatchDoubleAndSingleQuotedStringsAndHandleEscapes()
    {
        $matcher = new AnnotationStringMatcher();
        $this->assertMatcherResult($matcher, '"string string"', 'string string');
        $this->assertMatcherResult($matcher, "'string string'", "string string");
    }

    public function TODO_testStringMatcherShouldMatchEscapedStringsCorrectly()
    {
        $matcher = new AnnotationStringMatcher();
        $this->assertMatcherResult($matcher, '"string\"string"', 'string"string');
        $this->assertMatcherResult($matcher, "'string\'string'", "string'string");
    }
}
