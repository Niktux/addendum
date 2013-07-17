<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationsMatcher;
use Addendum\Parser\AnnotationParametersMatcher;

class AnnotationParametersMatcherTest extends AnnotationMatcherTestCase
{
    public function testParametersMatcherShouldMatchEmptyStringAndReturnEmptyArray()
    {
        $matcher = new AnnotationParametersMatcher();
        $this->assertSame($matcher->matches('', $value), 0);
        $this->assertEquals($value, array());
    }
    
    public function testParametersMatcherShouldMatchEmptyBracketsAndReturnEmptyArray()
    {
        $matcher = new AnnotationParametersMatcher();
        $this->assertSame($matcher->matches('()', $value), 2);
        $this->assertEquals($value, array());
    }
    
    public function testParametersMatcherShouldMatchMultilinedParameters()
    {
        $matcher = new AnnotationParametersMatcher();
        $block = "(
                key = true,
                key2 = false
            )";
        $this->assertMatcherResult($matcher, $block, array('key' => true, 'key2' => false));
    }
}