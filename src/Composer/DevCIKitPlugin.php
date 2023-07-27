<?php

declare(strict_types=1);

namespace DevCIKit\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use GrumPHP\Util\Filesystem;

/**
 * @psalm-suppress UnusedClass
 */
class DevCIKitPlugin implements PluginInterface, EventSubscriberInterface
{
    public function __construct(private ?Composer $composer = null, private ?IOInterface $io = null)
    {
    }

    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'copyFiles',
            ScriptEvents::POST_UPDATE_CMD => 'copyFiles',
        ];
    }

    public function copyFiles(?Filesystem $filesystem = null): void
    {
        $filesystem ??= new Filesystem();

        $projectDir = $filesystem->ensureValidSlashes(
            dirname((string) $this->composer?->getConfig()->get('vendor-dir'))
        );
        $packageDir = $filesystem->ensureValidSlashes(dirname(__DIR__, 2));

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
            $filesystem->copy(
                $packageDir . '/' . $fileName,
                $projectDir . '/' . $fileName . '.dist'
            );
        }

        $this->io?->write(
            '<fg=green>Dev CI Kit configuration files have been successfully copied.</fg=green>'
        );
        $this->io?->write(
            '<fg=yellow>Please rename the configuration files by removing the .dist extension.</fg=yellow>'
        );
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
