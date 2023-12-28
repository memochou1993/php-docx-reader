<?php

require __DIR__.'/vendor/autoload.php';

use App\DocParser;

$parser = new DocParser('./example.docx');
$text = $parser->getText();

print_r($text);
