<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationMatcher;
use Addendum\Parser\AnnotationValuesMatcher;

class AnnotationValuesMatcherTest extends AnnotationMatcherTestCase
{
    public function testValuesMatcherShouldMatchSimpleValueOrHash()
    {
        $matcher = new AnnotationValuesMatcher();
        $this->assertNotFalse($matcher->matches('true', $value));
        $this->assertNotFalse($matcher->matches('key=true', $value));
    }
}