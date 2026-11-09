<?php

use Euginepj\ApiSpecs\Http\Controllers\ApiSpecsController;
use Illuminate\Support\Facades\Route;

$prefix = config('api-specs.route_prefix', 'docs/api');
$middleware = config('api-specs.middleware', ['web']);

Route::middleware($middleware)->group(function () use ($prefix) {
    Route::get($prefix, [ApiSpecsController::class, 'index'])->name('api-specs.index');
});

