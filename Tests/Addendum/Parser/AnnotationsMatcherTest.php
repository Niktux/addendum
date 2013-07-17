<?php

namespace Tests\Addendum\Parser;

use Addendum\Parser\AnnotationsMatcher;

class AnnotationsMatcherTest extends AnnotationMatcherTestCase
{
    public function testAnnotationsMatcherShouldMatchAnnotationWithGarbage()
    {
        $expected = array('Annotation' => array(
            array('value' => true),
        ));
    
        $matcher = new AnnotationsMatcher();
        $this->assertMatcherResult($matcher, '/** asd bla bla @Annotation(true) */@', $expected);
    }
    
    public function testAnnotationsMatcherShouldNotMatchEmail()
    {
        $matcher = new AnnotationsMatcher();
        $this->assertMatcherResult($matcher, 'johno@example.com', array());
    }
    
    public function testAnnotationsMatcherShouldMatchWhenThereIsNoSpaceBetweenDocBlockMarginAndAt()
    {
        $matcher = new AnnotationsMatcher();
    
        $block = "/**\n *@Annotation(true)\n*/";
    
        $expected = array(
            'Annotation'=>array(
                array('value' => true)
            ));
    
        $this->assertMatcherResult($matcher, $block, $expected);
    }
    
    public function testAnnotationsMatcherShouldMatchWhenFirstThingOnALine()
    {
        $matcher = new AnnotationsMatcher();
        $expected = array('Annotation'=>array(array('value'=>true)));
        $block = "/**\n@Annotation(true)\n*/";
        $this->assertMatcherResult($matcher, $block, $expected);
    }
    
    public function testAnnotationsMatcherShouldMatchMultipleAnnotations()
    {
        $expected = array('Annotation' => array(
            array('value' => true),
            array('value' => false)
        ));
        $matcher = new AnnotationsMatcher();
        $this->assertMatcherResult($matcher, ' ss @Annotation(true) @Annotation(false)', $expected);
    }
    
    public function testAnnotationsMatcherShouldMatchMultipleAnnotationsOnManyLines()
    {
        $expected = array('Annotation' => array(
            array('value' => true),
            array('value' => false)
        ));
        $block = "/**
                @Annotation(true)
                @Annotation(false)
            **/";
        $matcher = new AnnotationsMatcher();
        $this->assertMatcherResult($matcher, $block, $expected);
    }
    
    public function testAnnotationMatcherShouldMatchMultilineAnnotations()
    {
        $block= '/**
                 * @Annotation(
                       paramOne="value1",
                       paramTwo={
                     "value2" ,
                        {"one", "two"}
                       },
                       paramThree="three"
                )
             */';
        $expected = array('Annotation' => array(
            array(
                'paramOne' => 'value1',
                'paramTwo' => array('value2', array('one', 'two')),
                'paramThree' => 'three',
            )
        ));
        $matcher = new AnnotationsMatcher();
        $this->assertMatcherResult($matcher, $block, $expected);
    }
}