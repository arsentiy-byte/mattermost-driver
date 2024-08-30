<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())->in(__DIR__.'/src');

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        'declare_strict_types' => true,
        'strict_param' => true,
        'final_class' => true,
        'multiline_whitespace_before_semicolons' => true,
    ])
    ->setFinder($finder);
