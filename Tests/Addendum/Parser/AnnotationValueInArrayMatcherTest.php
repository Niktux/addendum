<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationMatcher;
use Addendum\Parser\AnnotationValueInArrayMatcher;

class AnnotationValueInArrayMatcherTest extends AnnotationMatcherTestCase
{
    public function testValueInArrayMatcherReturnsAValueInArray()
    {
        $matcher = new AnnotationValueInArrayMatcher();
        $this->assertMatcherResult($matcher, '1', array(1));
    }
}