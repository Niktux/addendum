<?php

namespace tests\Addendum\Parser;

class AnnotationMatcherTestCase extends \PHPUnit_Framework_TestCase
{
    protected function assertNotFalse($value)
    {
        $this->assertNotSame(false, $value);
    }
    
    protected function assertMatcherResult($matcher, $string, $expected)
    {
        $value = null;
        $this->assertNotSame($matcher->matches($string, $value), false);
        $this->assertSame($expected, $value);
    }
}