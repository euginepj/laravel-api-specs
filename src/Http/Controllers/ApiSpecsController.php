<?php

namespace Euginepj\ApiSpecs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class ApiSpecsController extends Controller
{
    /**
     * Render the interactive API specification portal.
     */
    public function index(Request $request): View
    {
        $endpointsFile = config('api-specs.endpoints_file', resource_path('api-specs/endpoints.php'));

        $data = file_exists($endpointsFile) ? require $endpointsFile : ['groups' => []];
        $groups = $data['groups'] ?? [];

        $branding = config('api-specs.branding', [
            'badge' => 'REST API Spec',
            'title' => 'API Docs',
            'subtitle' => 'v1.0',
            'base_url' => '/api',
            'overview_title' => 'API Specification',
            'overview_description' => 'Interactive REST API specification documentation.',
        ]);

        return view('api-specs::index', [
            'groups' => $groups,
            'branding' => $branding,
        ]);
    }
}

