<?php

/** class doccomment */
class SomeClass
{
    /** field doccomment */
    private $field1;

    private $field2;

    /** method1 doccomment */
    public function method1()
    {
    }

    public function method2() {}
    /** bad one */
}

class SomeOtherClass
{
    /** field doccomment */
    private $field1;
}

/** interface doccomment */
interface SomeInterface
{
    /** method doccomment */
    public function method();
}