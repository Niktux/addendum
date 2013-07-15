<?php

namespace Addendum\Parser;

class AnnotationSingleQuotedStringMatcher extends RegexMatcher
{
    public function __construct()
    {
        parent::__construct("'([^']*)'");
    }

    protected function process($matches)
    {
        return $matches[1];
    }
}