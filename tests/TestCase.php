<?php

namespace DevCIKit\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery\MockInterface;
use Tests\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected MockInterface $fileSystem;

    protected MockInterface $event;

    protected MockInterface $composer;

    protected MockInterface $io;

    protected string $packageDir;

    protected array $fileNames;
}
