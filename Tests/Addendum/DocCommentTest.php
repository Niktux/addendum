<?php

namespace Tests\Addendum;

use Addendum\DocComment;
use \ReflectionClass as ReflectionClass;

require __DIR__ . '/Fixtures/DocCommentTestData.php';

class DocCommentTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        DocComment::clearCache();
    }

    public function testFinderFindsClassDocBlock()
    {
        $reflection = new ReflectionClass('SomeClass');
        $finder = new DocComment();
        $this->assertEquals($finder->get($reflection), '/** class doccomment */');
    }
    
    public function testFinderFindsInterfaceDocBlock()
    {
        $reflection = new ReflectionClass('SomeInterface');
        $finder = new DocComment();
        $this->assertEquals('/** interface doccomment */', $finder->get($reflection));
    }
    
    public function testFinderFindsInterfaceMethodDocBlock()
    {
        $reflection = new ReflectionClass('SomeInterface');
        $method = $reflection->getMethod('method');
        $finder = new DocComment();
        $this->assertEquals('/** method doccomment */', $finder->get($method));
    }
    
    public function testFinderFindsFieldDocBlock()
    {
        $reflection = new ReflectionClass('SomeClass');
        $property = $reflection->getProperty('field1');
        $finder = new DocComment();
        $this->assertEquals($finder->get($property), '/** field doccomment */');
        $property = $reflection->getProperty('field2');
        $finder = new DocComment();
        $this->assertFalse($finder->get($property));
    }
    
    public function testFinderFindsMethodDocBlock()
    {
        $reflection = new ReflectionClass('SomeClass');
        $method = $reflection->getMethod('method1');
        $finder = new DocComment();
        $this->assertEquals($finder->get($method), '/** method1 doccomment */');
        $method = $reflection->getMethod('method2');
        $finder = new DocComment();
        $this->assertFalse($finder->get($method));
    }
    
    public function testMisplacedDocCommentDoesNotCausesDisaster()
    {
        $reflection = new ReflectionClass('SomeOtherClass');
        $finder = new DocComment();
        $this->assertEquals($finder->get($reflection), false);
    }
    
    public function testUnanotatedClassCanHaveAnotatedField()
    {
        $reflection = new ReflectionClass('SomeOtherClass');
        $property = $reflection->getProperty('field1');
        $finder = new DocComment();
        $this->assertEquals($finder->get($property), '/** field doccomment */');
    }
    
    public function testParserIsOnlyCalledOncePerFile()
    {
        $reflection = new ReflectionClass('SomeClass');
        
        $mock = $this->getMock('Addendum\DocComment', array('parse'));
        $mock->expects($this->once())
             ->method('parse');
        
        $this->assertEquals($mock->get($reflection), false);
        $this->assertEquals($mock->get($reflection), false);
        
        $reflection = new ReflectionClass('SomeClass');
        $this->assertEquals($mock->get($reflection), false);
    }
}
