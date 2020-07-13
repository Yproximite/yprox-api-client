<?php

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__.'/src'])
;

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setRules([
        '@Symfony'                              => true,
        'array_syntax'                          => ['syntax' => 'short'],
        'declare_strict_types'                  => false,
        'binary_operator_spaces'                => [
            'align_double_arrow' => true,
            'align_equals'       => true,
        ],
        'braces'                                => ['allow_single_line_closure' => true],
        'native_constant_invocation'            => true,
        'native_function_invocation'            => [
            'include' => ['@compiler_optimized'],
            'scope'   => 'namespaced',
        ],
        'phpdoc_summary'                        => false,
        'no_superfluous_phpdoc_tags'            => true,
        'no_unreachable_default_argument_value' => true,
        'no_unused_imports'                     => false
    ])
;
