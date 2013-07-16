<?php

namespace Tests\Addendum;

use Addendum\Addendum;

require_once __DIR__ . '/Fixtures/AddendumTestData.php';

class AddendumTest extends \PHPUnit_Framework_TestCase
{
    public function testClassResolverShouldFindClassBasedOnName()
    {
        $this->assertEquals(Addendum::resolveClassName('SimpleClass'), 'SimpleClass');
    }
    
    public function testClassResolverShouldFindClassBasedOnSuffix()
    {
        $this->assertEquals(Addendum::resolveClassName('ClassWithNamespace'), 'Namespace_ClassWithNamespace');
        $this->assertEquals(Addendum::resolveClassName('WithNamespace'), 'WithNamespace');
        $this->assertEquals(Addendum::resolveClassName('Annotation_AClass'), 'Namespace_Annotation_AClass');
        $this->assertEquals(Addendum::resolveClassName('AClass'), 'Namespace_Annotation_AClass'); // this is crucial
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testClassResolverShouldTriggerErrorOnCommonSuffix()
    {
   //     $this->expectOutputString("Cannot resolve class name for 'CommonSuffix'. Possible matches: Namespace1_CommonSuffix, Namespace2_CommonSuffix");
        Addendum::resolveClassName('CommonSuffix');
    }
}