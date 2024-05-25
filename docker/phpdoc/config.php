<?php

use Doctum\Doctum;
use Symfony\Component\Finder\Finder;

$dir = '/source';
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in($dir);

return new Doctum($iterator, [
    'title' => 'Support Api Documentation',
]);
