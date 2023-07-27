<?php

declare(strict_types=1);

namespace DevCIKit\Tests\Unit\Composer;

use Composer\Composer;
use Composer\Config;
use Composer\IO\IOInterface;
use Composer\Script\Event;
use DevCIKit\Composer\DevCIKitPlugin;
use GrumPHP\Util\Filesystem;
use Mockery;

test('The configuration files exist.', function () {
    $composer = Mockery::mock(Composer::class);
    $config = Mockery::mock(Config::class);
    $io = Mockery::mock(IOInterface::class);
    $fileSystem = Mockery::mock(Filesystem::class);
    $event = Mockery::mock(Event::class);

    $packageDir = rtrim(dirname(__DIR__, 3), '/');

    $event->shouldReceive('getComposer')->andReturns($composer);
    $event->shouldReceive('getIO')->andReturns($io);
    $composer->shouldReceive('getConfig')->andReturns($config);
    $io->shouldReceive('write')->andReturns();
    $config->shouldReceive('get')->with('vendor-dir')->andReturns($packageDir);
    $fileSystem->shouldReceive('copy')->andReturns();
    $fileSystem->shouldReceive('ensureValidSlashes')->andReturns('');

    $integrationObject = new DevCIKitPlugin();
    $integrationObject->copyFiles($event, $fileSystem);

    $fileNames = [
        'grumphp.yml',
        'infection.json',
        'phpcs.xml',
        'phpunit.xml',
        'psalm.xml',
        'rector.php',
        'deptrac.yaml',
        '.editorconfig',
        'var/.cache/deptrac/.gitignore',
        'var/.cache/infection/.gitignore',
        'var/.cache/phpcs/.gitignore',
        'var/.cache/phpunit/.gitignore',
        'var/.cache/psalm/.gitignore',
        'var/.cache/rector/.gitignore',
        'var/.report/.gitignore',
    ];


    foreach ($fileNames as $fileName) {
        expect(file_exists($packageDir . '/' . $fileName))->toBeTrue();
    }
});
