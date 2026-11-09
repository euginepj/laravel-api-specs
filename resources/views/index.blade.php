@extends('api-specs::layout')

@section('content')
<div class="layout">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <div class="brand-badge">{{ $branding['badge'] ?? 'REST API Spec' }}</div>
      <div class="brand-title">
        <svg class="brand-logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
        </svg>
        {{ $branding['title'] ?? 'API Docs' }}
      </div>
      <div class="brand-subtitle">{{ $branding['subtitle'] ?? '' }}</div>
    </div>

    <nav class="sidebar-nav" id="sidebarNav">
      @foreach($groups as $index => $group)
        @php
          $isOpen = $loop->first;
          $groupId = $group['id'] ?? ('group-' . ($index + 1));
        @endphp
        <div class="nav-group {{ $isOpen ? 'is-open' : '' }}" data-group="{{ $groupId }}">
          <button class="nav-section-header" type="button" aria-expanded="{{ $isOpen ? 'true' : 'false' }}">
            <div class="nav-section-title-wrap">
              <span class="num">{{ $index + 1 }}</span>
              <span>{{ $group['title'] ?? 'Domain' }}</span>
            </div>
            <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
          </button>
          <div class="nav-sub-items">
            @foreach($group['endpoints'] ?? [] as $endpoint)
              @php
                $method = strtoupper($endpoint['method'] ?? 'GET');
                $methodClass = match($method) {
                    'GET' => 'method-get',
                    'POST' => 'method-post',
                    'PUT', 'PATCH' => 'method-put',
                    'DELETE' => 'method-delete',
                    default => 'method-get',
                };
                $endpointId = $endpoint['id'] ?? Str::slug($endpoint['path'] ?? 'endpoint');
              @endphp
              <a href="#{{ $endpointId }}" class="nav-item">
                <span>{{ $endpoint['title'] ?? ($endpoint['path'] ?? 'Endpoint') }}</span>
                <span class="method-pill {{ $methodClass }}">{{ $method }}</span>
              </a>
            @endforeach
          </div>
        </div>
      @endforeach
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="content">
    <!-- Header Banner -->
    <div class="hero-banner" id="overview">
      <h1>{{ $branding['overview_title'] ?? ($branding['title'] ?? 'API Documentation') }}</h1>
      <p>
        {{ $branding['overview_description'] ?? 'Interactive REST API specification documentation.' }}
      </p>

      <div class="hero-meta">
        <div class="meta-box">
          <strong>Base URL</strong>
          <code>{{ $branding['base_url'] ?? '/api' }}</code>
        </div>
        <div class="meta-box">
          <strong>Version</strong>
          <code>{{ $branding['subtitle'] ?? 'v1.0' }}</code>
        </div>
        <div class="meta-box">
          <strong>Auth Standard</strong>
          <code>Bearer Token (Sanctum)</code>
        </div>
        <div class="meta-box">
          <strong>Format</strong>
          <code>application/json</code>
        </div>
      </div>
    </div>

    <!-- Endpoint Sections -->
    @foreach($groups as $index => $group)
      @php
        $groupId = $group['id'] ?? ('group-' . ($index + 1));
      @endphp
      <section class="section-block" id="{{ $groupId }}">
        <h2 class="section-title">
          <span class="badge-num">{{ $index + 1 }}</span>
          {{ $group['title'] ?? 'Domain' }}
        </h2>
        @if(!empty($group['description']))
          <p class="section-desc">{{ $group['description'] }}</p>
        @endif

        @foreach($group['endpoints'] ?? [] as $endpoint)
          <x-api-specs::endpoint-card :endpoint="$endpoint" :groupId="$groupId" />
        @endforeach
      </section>
    @endforeach
  </main>
</div>
@endsection

