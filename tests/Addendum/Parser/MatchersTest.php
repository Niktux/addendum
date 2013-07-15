<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\RegexMatcher;
use Addendum\Parser\ParallelMatcher;
use Addendum\Parser\SerialMatcher;
use Addendum\Parser\SimpleSerialMatcher;

class MatchersTest extends \PHPUnit_Framework_TestCase
{
    public function testRegexMatcherShouldMatchPatternAndReturnLengthOfMatch()
    {
        $matcher = new RegexMatcher('[0-9]+');
        $this->assertSame($matcher->matches('1234a', $value), 4);
        $this->assertSame($value, '1234');
    }
    
    public function testRegexMatcherShouldReturnFalseOnNoMatch()
    {
        $matcher = new RegexMatcher('[0-9]+');
        $this->assertFalse($matcher->matches('abc123', $value));
    }
    
    public function testParallelMatcherShouldMatchLongerStringOnColision()
    {
        $matcher = new ParallelMatcher();
        $matcher->add(new RegexMatcher('true'));
        $matcher->add(new RegexMatcher('.+'));
        $this->assertEquals($matcher->matches('truestring', $value), 10);
        $this->assertEquals($value, 'truestring');
    }
    
    public function testSerialMatcherShouldMatchAllParts()
    {
        $matcher = new SerialMatcher();
        $matcher->add(new RegexMatcher('[a-zA-Z0-9_]+'));
        $matcher->add(new RegexMatcher('='));
        $matcher->add(new RegexMatcher('[0-9]+'));
        $this->assertEquals($matcher->matches('key=20', $value), 6);
        $this->assertEquals($value, 'key=20');
    }
    
    public function testSerialMatcherShouldFailIfAnyPartDoesNotMatch()
    {
        $matcher = new SerialMatcher();
        $matcher->add(new RegexMatcher('[a-zA-Z0-9_]+'));
        $matcher->add(new RegexMatcher('='));
        $matcher->add(new RegexMatcher('[0-9]+'));
        $this->assertFalse($matcher->matches('key=a20', $value));
    }
    
    public function testSimpleSerialMatcherShouldReturnRequestedPartOnMatch()
    {
        $matcher = new SimpleSerialMatcher(1);
        $matcher->add(new RegexMatcher('\('));
        $matcher->add(new RegexMatcher('[0-9]+'));
        $matcher->add(new RegexMatcher('\)'));
        $this->assertEquals($matcher->matches('(1234)', $value), 6);
        $this->assertEquals($value, '1234');
    }
}
