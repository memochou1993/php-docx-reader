<?php

namespace App;

use PhpOffice\PhpWord\IOFactory;

class DocParser
{
    private $parser;

    private $text = '';

    public function __construct($filename)
    {
        $this->parser = IOFactory::load($filename);
    }

    public function getText()
    {
        $sections = $this->parser->getSections();

        foreach ($sections as $section) {
            $elements = $section->getElements();
            $this->parseElements($elements);
        }

        return $this->text;
    }

    private function parseElements($elements)
    {
        foreach ($elements as $element) {
            $this->parseElement($element);
        }
    }

    private function parseElement($element)
    {
        if (method_exists($element, 'getElements')) {
            $childElements = $element->getElements();
            $this->parseElements($childElements);
        }

        if (method_exists($element, 'getText')) {
            $this->text .= $element->getText();
        }
    }
}
