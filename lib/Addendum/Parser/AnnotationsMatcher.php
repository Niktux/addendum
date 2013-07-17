<?php

namespace Addendum\Parser;

class AnnotationsMatcher
{
    public function matches($string, &$annotations)
    {
        $annotations = array();
        $annotation_matcher = new AnnotationMatcher;
        
        while(true)
        {
            if(preg_match('~(?<leadingSpace>\s)?(?=@)~', $string, $matches, PREG_OFFSET_CAPTURE))
            {
                $offset = $matches[0][1];
                
                if(isset($matches['leadingSpace']))
                {
                    $offset += 1;
                }
                
                $string = substr($string, $offset);
            }
            else
            {
                break; // no more annotations
            }
            
            if(($length = $annotation_matcher->matches($string, $data)) !== false)
            {
                $string = substr($string, $length);
                list($name, $params) = $data;
                $annotations[$name][] = $params;
            }
            else
            {
                // Move on !
                $string = substr($string, 1);
            }
        }
    }
}