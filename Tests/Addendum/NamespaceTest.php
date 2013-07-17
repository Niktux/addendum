<?php

namespace Tests\Addendum;

use Addendum\ReflectionAnnotatedClass;

require_once __DIR__ . '/Fixtures/NamespaceTestData.php';

class NamespaceTest extends \PHPUnit_Framework_TestCase
{
    public function testClassAndAnnotationInNamespaces()
    {
        $reflection = new ReflectionAnnotatedClass('Example\Example');
        $this->assertTrue($reflection->hasAnnotation('Example\Annotation\ExampleAnnotation'));
    }
}

