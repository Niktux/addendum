<?php

use Addendum\Annotation;

class TestingAnnotation extends Annotation
{
    public $optional = 'default';
    public $required;
}

class Annotation1 extends Annotation {}
class Annotation2 extends Annotation {}
class Namespace_Annotation3 extends Annotation {}