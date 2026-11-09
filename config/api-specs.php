<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Documentation Route Prefix
    |--------------------------------------------------------------------------
    |
    | The URI path where the interactive API documentation will be accessible.
    | e.g., 'docs/api' will map to https://your-app.test/docs/api
    |
    */
    'route_prefix' => env('API_SPECS_ROUTE', 'docs/api'),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Define the middleware applied to the documentation route. Use ['web'] for
    | public access, or add auth middleware such as ['web', 'auth'].
    |
    */
    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Branding & Metadata
    |--------------------------------------------------------------------------
    |
    | Display names, badges, subtitles, and external links rendered in the portal.
    |
    */
    'branding' => [
        'badge' => 'REST API Spec',
        'title' => 'TANDEEF API',
        'subtitle' => 'v1.0 • Laravel 13 • PHP 8.3',
        'base_url' => env('API_SPECS_BASE_URL', '/api'),
        'overview_title' => 'TANDEEF Cleaning Platform API',
        'overview_description' => 'Interactive REST API specification with 2-column parameter schemas and copyable payloads.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Endpoints Definition File
    |--------------------------------------------------------------------------
    |
    | Path to the PHP file returning the array of endpoint groups and definitions.
    |
    */
    'endpoints_file' => resource_path('api-specs/endpoints.php'),
];

