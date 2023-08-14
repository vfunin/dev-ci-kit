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

beforeEach(function () {
    $this->composer = Mockery::mock(Composer::class);
    $config = Mockery::mock(Config::class);
    $this->io = Mockery::mock(IOInterface::class);
    $this->fileSystem = Mockery::mock(Filesystem::class);
    $this->event = Mockery::mock(Event::class);

    $this->packageDir = rtrim(dirname(__DIR__, 3), '/');

    $this->fileNames = [
        'grumphp.yml',
        'infection.json',
        'phpcs.xml',
        'phpunit.xml',
        'psalm.xml',
        'phpstan.neon',
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

    $this->event->shouldReceive('getComposer')->andReturns($this->composer);
    $this->event->shouldReceive('getIO')->andReturns($this->io);
    $this->composer->shouldReceive('getConfig')->andReturns($config);
    $this->io->shouldReceive('write')->andReturns();
    $config->shouldReceive('get')->with('vendor-dir')->andReturns($this->packageDir);
    $this->fileSystem->shouldReceive('copy')->andReturns();
    $this->fileSystem->shouldReceive('ensureValidSlashes')->andReturns('');
});

test('The configuration files exist.', function () {
    $integrationObject = new DevCIKitPlugin();
    $integrationObject->copyFiles($this->event, $this->fileSystem);

    foreach ($this->fileNames as $fileName) {
        expect(file_exists($this->packageDir . '/' . $fileName))->toBeTrue();
    }
});

test('Get subscribed event', function () {
    expect(DevCIKitPlugin::getSubscribedEvents())->toMatchArray([
        'post-install-cmd' => 'copyFiles',
        'post-update-cmd' => 'copyFiles',
    ]);
});

test('Init', function () {
    (new DevCIKitPlugin())::init($this->event, $this->fileSystem);
    foreach ($this->fileNames as $fileName) {
        expect(file_exists($this->packageDir . '/' . $fileName))->toBeTrue();
    }
});

test('That plugin implements', function () {
    expect((new DevCIKitPlugin()))->toHaveMethods(['activate', 'deactivate', 'uninstall']);
});
