<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $compiledPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'credfast-test-views-'.uniqid();
        File::ensureDirectoryExists($compiledPath);

        config()->set('view.compiled', $compiledPath);
        $this->withoutVite();
    }
}
