<?php

namespace Euginepj\ApiSpecs\Tests;

use Euginepj\ApiSpecs\ApiSpecsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ApiSpecsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('api-specs.route_prefix', 'docs/api');
        $app['config']->set('api-specs.middleware', ['web']);
    }
}

