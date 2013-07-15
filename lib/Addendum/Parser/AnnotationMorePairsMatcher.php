<?php

namespace Addendum\Parser;

class AnnotationMorePairsMatcher extends SerialMatcher
{
    protected function build()
    {
        $this->add(new AnnotationPairMatcher);
        $this->add(new RegexMatcher('\s*,\s*'));
        $this->add(new AnnotationHashMatcher);
    }

    protected function match($string, &$value)
    {
        $result = parent::match($string, $value);
        
        return $result;
    }

    public function process($parts)
    {
        return array_merge($parts[0], $parts[2]);
    }
}