<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenFinalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenPrivateMethods;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenTraits;
use NunoMaduro\PhpInsights\Domain\Metrics\Architecture\Classes;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DeclareStrictTypesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\ParameterTypeHintSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\PropertyTypeHintSniff;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Preset
    |--------------------------------------------------------------------------
    |
    | This option controls the default preset that will be used by PHP Insights
    | to make your code reliable, simple, and clean. However, you can always
    | adjust the `Metrics` and `Insights` below in this configuration file.
    |
    | Supported: "default", "laravel", "symfony", "magento2", "drupal"
    |
    */

    'preset' => 'laravel',

    /*
    |--------------------------------------------------------------------------
    | Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may adjust all the various `Insights` that will be used by PHP
    | Insights. You can either add, remove or configure `Insights`. Keep in
    | mind that all added `Insights` must belong to a specific `Metric`.
    |
    */

    'exclude' => [
        //  'path/to/directory-or-file'
    ],

    'add' => [
        Classes::class => [
            ForbiddenFinalClasses::class,
        ],
    ],

    'remove' => [
        DeclareStrictTypesSniff::class,
        ForbiddenNormalClasses::class,
        ForbiddenTraits::class,
        NoEmptyCommentFixer::class,
        SpaceAfterNotSniff::class,
    ],

    'config' => [
        ForbiddenPrivateMethods::class => [
            'title' => 'The usage of private methods is not idiomatic in Laravel.',
        ],
        OrderedClassElementsFixer::class => [
            'order' => [
                'use_trait',
                'constant',
                'property',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method',
            ],
            'sortAlgorithm' => 'alpha'
        ],
        ParameterTypeHintSniff::class => [
            'exclude' => [
                'app/Exceptions/Handler.php',
                'app/Http/Middleware',
                'app/Rules',
                'app/Filters',
            ],
        ],
        PropertyTypeHintSniff::class => [
            'exclude' => [
                'app/Console/Kernel.php',
                'app/Exceptions/Handler.php',
                'app/Http/Kernel.php',
                'app/Http/Middleware',
                'app/Models',
                'app/Providers',
            ],
        ],
        UnusedParameterSniff::class => [
            'exclude' => [
                'app/Console/Kernel.php',
                'app/Filters',
                'app/Sorts',
                'app/Notifications',
                'app/Rules',
            ],
        ],
        UselessOverridingMethodSniff::class => [
            'exclude' => [
                'app/Exceptions/Handler.php',
                'app/Providers',
            ],
        ],
    ],

];
