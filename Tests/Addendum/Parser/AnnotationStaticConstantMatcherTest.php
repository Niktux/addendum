<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationStaticConstantMatcher;

require_once __DIR__ . '/AnnotationMatchersTestData.php';

class AnnotationStaticConstantMatcherTest extends AnnotationMatcherTestCase
{
    public function testStaticConstantMatcherShouldMatchConstants()
    {
        $matcher = new AnnotationStaticConstantMatcher();
        $this->assertMatcherResult($matcher, 'StaticClass::A_CONSTANT', \StaticClass::A_CONSTANT);
    }
    
    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testStaticConstantMatcherShouldThrowErrorOnBadConstant()
    {
        //        $this->expectError("Constant 'StaticClass::NO_CONSTANT' used in annotation was not defined.");
        $matcher = new AnnotationStaticConstantMatcher();
        $matcher->matches('StaticClass::NO_CONSTANT', $value);
    }
}