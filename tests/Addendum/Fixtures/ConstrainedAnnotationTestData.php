<?php

use Addendum\Annotation;

/** @Target("class") */
class ClassRestrictedAnnotation extends Annotation {}

/** @Target("method") */
class MethodRestrictedAnnotation extends Annotation {}

/** @Target("property") */
class PropertyRestrictedAnnotation extends Annotation {}

/** @Target("nested") */
class NestedRestrictedAnnotation extends Annotation {}

/** @Target({"class", "property"}) */
class ClassOrPropertyRestrictedAnnotation extends Annotation {}


class BadlyAnnotatedClass
{
    /** @ClassRestrictedAnnotation */
    private $property;

    /** @ClassRestrictedAnnotation */
    public function method() {}

    /** @ClassOrPropertyRestrictedAnnotation */
    public function method2() {}
}

/** @ClassRestrictedAnnotation(value = @MethodRestrictedAnnotation(true)) */
class ClassWithBadlyNestedAnnotations {}

/** @ClassRestrictedAnnotation */
class SuccesfullyAnnotatedClass
{
    /** @PropertyRestrictedAnnotation */
    private $property;

    /** @ClassOrPropertyRestrictedAnnotation */
    private $property2;

    /** @MethodRestrictedAnnotation */
    public function method() {}

    /** @MethodRestrictedAnnotation(value = @NestedRestrictedAnnotation) */
    public function method2() {}
}