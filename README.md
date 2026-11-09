# Euginepj Laravel API Specs

An interactive, modern, two-column REST API documentation portal for Laravel applications inspired by Stripe and Scalar developer portals.

![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Laravel 11, 12, 13](https://img.shields.io/badge/Laravel-11%20%7C%2012%20%7C%2013-red)
![License MIT](https://img.shields.io/badge/License-MIT-green)

---

## Features

- 📑 **2-Column Side-by-Side Split**: Specs and parameter schemas on the left; sticky dark code console with copyable payloads on the right.
- 📂 **Collapsible Sidebar Accordion**: Sections expand/collapse smoothly and auto-highlight as you scroll.
- 📋 **1-Click Copy**: Copy request and response payloads with instant feedback.
- 🎨 **Status Badges & Parameter Chips**: Crisp monospaced badges for HTTP verbs, required fields, data types, and validation constraints.
- 🔒 **Configurable Middleware**: Easily secure docs behind auth gates (`['web', 'auth']`) or keep them public.
- ⚡ **Zero-Build Overhead**: Works right out of the box with zero npm or node build requirements.

---

## Installation

```bash
composer require euginepj/laravel-api-specs
```

Publish configuration and endpoint data templates:

```bash
php artisan vendor:publish --tag=api-specs-config
php artisan vendor:publish --tag=api-specs-content
```

---

## Configuration

In `config/api-specs.php`:

```php
return [
    // Route URL to access documentation (e.g. /docs/api)
    'route_prefix' => env('API_SPECS_ROUTE', 'docs/api'),

    // Middleware applied to the docs route
    'middleware' => ['web'],

    // Portal header branding
    'title' => 'TANDEEF API',
    'badge' => 'REST API Spec',
    'subtitle' => 'v1.0 • Laravel 13 • PHP 8.3',

    // Base API URL
    'base_url' => env('API_SPECS_BASE_URL', '/api'),

    // Path to the endpoints definition file
    'endpoints_file' => resource_path('api-specs/endpoints.php'),
];
```

---

## Defining Endpoints

Edit `resources/api-specs/endpoints.php`:

```php
return [
    'groups' => [
        [
            'id' => 'auth',
            'title' => 'Authentication',
            'description' => 'Customer authentication and token lifecycle.',
            'endpoints' => [
                [
                    'id' => 'auth-login',
                    'method' => 'POST',
                    'path' => '/api/auth/login',
                    'auth' => 'Public',
                    'description' => 'Authenticate customer credentials and generate an API bearer token.',
                    'parameters' => [
                        [
                            'name' => 'email',
                            'type' => 'string',
                            'required' => true,
                            'description' => 'Registered customer email address.',
                            'rules' => ['email'],
                        ],
                        [
                            'name' => 'password',
                            'type' => 'string',
                            'required' => true,
                            'description' => 'Customer account password.',
                            'rules' => ['min:8'],
                        ],
                    ],
                    'request_body' => [
                        'email' => 'sarah@example.com',
                        'password' => 'Password123!',
                    ],
                    'responses' => [
                        [
                            'status' => '200',
                            'label' => '200 OK',
                            'body' => [
                                'success' => true,
                                'token' => '1|token...',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
```

---

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

