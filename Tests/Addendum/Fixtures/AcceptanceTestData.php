<?php

use Addendum\Annotation;

interface DummyInterface {}

/** @FirstAnnotation @SecondAnnotation */
interface ExampleInterface {}

class ParentExample {}

/** @FirstAnnotation @SecondAnnotation */
class Example extends ParentExample implements DummyInterface
{
    /** @SecondAnnotation */
    private $exampleProperty;

    public $publicOne;

    public function __construct() {}

    /** @FirstAnnotation */
    public function exampleMethod()
    {
    }

    private function justPrivate() {}
}

/** @FirstAnnotation(1) @FirstAnnotation(2) @SecondAnnotation(3) */
class MultiExample
{
    /** @FirstAnnotation(1) @FirstAnnotation(2) @SecondAnnotation(3) */
    public $property;

    /** @FirstAnnotation(1) @FirstAnnotation(2) @SecondAnnotation(3) */
    public function aMethod() {}
}

class FirstAnnotation extends Annotation
{
    public $key;
}

class SecondAnnotation extends Annotation {}

class NoAnnotation {}

/** @NoAnnotation @FirstAnnotation */
class ExampleWithInvalidAnnotation {}

/** @SelfReferencingAnnotation */
class SelfReferencingAnnotation extends Annotation {}

/** @IndirectReferenceLoopAnnotationHelper */
class IndirectReferenceLoopAnnotation extends Annotation {}

/** @IndirectReferenceLoopAnnotation */
class IndirectReferenceLoopAnnotationHelper extends Annotation {}


class Statics
{
    const A_CONSTANT = 'constant';
    static public $static = 'static';
}

/** @FirstAnnotation(Statics::A_CONSTANT) */
class ClassAnnotatedWithStaticConstant {}

/** @FirstAnnotation(Statics::UNKNOWN_CONSTANT) */
class ClassAnnotatedWithNonExistingConstant {}

/** @FirstAnnotation(key = @SecondAnnotation(3.14)) */
class ClassAnnotatedWithNestedAnnotations {}

class Namespace_AnnotationWithNamespace extends Annotation {}

/** @AnnotationWithNamespace */
class ClassAnnotatedWithNamespacedAnnotation {}