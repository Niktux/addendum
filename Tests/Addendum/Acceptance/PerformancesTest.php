<?php

namespace Tests\Addendum\Acceptance;

use Addendum\AnnotationsBuilder;

require_once __DIR__ . '/../Fixtures/AcceptanceTestData.php';

class PerformancesTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        AnnotationsBuilder::clearCache();
    }

    public function tearDown()
    {
        AnnotationsBuilder::clearCache();
    }

    public function testBuilderShouldCacheResults()
    {
        $builder = $this->getMock('Addendum\AnnotationsBuilder', array('getDocComment'));
        
        $builder->expects($this->once())
                 ->method('getDocComment');
        
        $reflection = new \ReflectionClass('Example');
        $builder->build($reflection);
        $builder->build($reflection);
    }
}