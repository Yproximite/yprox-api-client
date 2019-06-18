<?php
$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__.'/src'])
    ->exclude(['spec'])
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony'               => true,
        'array_syntax'           => [
            'syntax' => 'short',
        ],
        'binary_operator_spaces' => [
            'align_double_arrow' => true,
            'align_equals'       => true,
        ],
        'braces'                 => [
            'allow_single_line_closure' => true,
        ],
    ])
    ->setFinder($finder)
;
