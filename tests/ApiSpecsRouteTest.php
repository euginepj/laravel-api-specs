<?php

namespace Euginepj\ApiSpecs\Tests;

class ApiSpecsRouteTest extends TestCase
{
    public function test_api_specs_route_can_be_accessed(): void
    {
        $response = $this->get('/docs/api');

        $response->assertStatus(200);
        $response->assertSee('REST API Spec');
    }

    public function test_api_specs_renders_custom_branding(): void
    {
        config()->set('api-specs.branding.title', 'Acme Custom API');

        $response = $this->get('/docs/api');

        $response->assertStatus(200);
        $response->assertSee('Acme Custom API');
    }
}
