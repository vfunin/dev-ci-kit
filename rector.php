<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\CodingStyle\Rector\Closure\StaticClosureRector;
use Rector\Config\RectorConfig;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->cacheDirectory('./var/.cache/rector');

    $rectorConfig->skip([
        RenameVariableToMatchMethodCallReturnTypeRector::class,
        StaticClosureRector::class,
    ]);

    // define sets of rules
    $rectorConfig->sets([
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::DEAD_CODE,
        SetList::NAMING,
        LevelSetList::UP_TO_PHP_82
    ]);
};
