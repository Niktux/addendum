<?php

namespace Tests\Addendum\Acceptance;

use Addendum\Addendum;
use Addendum\ReflectionAnnotatedClass;

require_once __DIR__ . '/../Fixtures/AcceptanceTestData.php';

class SupportingFeaturesTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Addendum::resetIgnoredAnnotations();
    }

    public function tearDown()
    {
        Addendum::resetIgnoredAnnotations();
    }

    public function testIgnoredAnnotationsAreNotUsed()
    {
        Addendum::ignore('FirstAnnotation', 'SecondAnnotation');
        $reflection = new ReflectionAnnotatedClass('Example');
        $this->assertFalse($reflection->hasAnnotation('FirstAnnotation'));
        $this->assertFalse($reflection->hasAnnotation('SecondAnnotation'));
    }
}