<?php

namespace Addendum\Parser;

class AnnotationStringMatcher extends ParallelMatcher
{
    protected function build()
    {
        $this->add(new AnnotationSingleQuotedStringMatcher);
        $this->add(new AnnotationDoubleQuotedStringMatcher);
    }
}