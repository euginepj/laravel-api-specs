@props([
    'endpoint',
    'groupId' => ''
])

@php
    $method = strtoupper($endpoint['method'] ?? 'GET');
    $methodClass = match($method) {
        'GET' => 'method-get',
        'POST' => 'method-post',
        'PUT', 'PATCH' => 'method-put',
        'DELETE' => 'method-delete',
        default => 'method-get',
    };
    $auth = $endpoint['auth'] ?? 'Public';
    $isPublic = strtolower($auth) === 'public';
    $endpointId = $endpoint['id'] ?? Str::slug($endpoint['path'] ?? 'endpoint');
    $reqTabId = 'req-' . $endpointId;
@endphp

<div class="endpoint-card" id="{{ $endpointId }}">
  <div class="endpoint-header">
    <div class="endpoint-path">
      <span class="method-pill {{ $methodClass }}">{{ $method }}</span>
      <span>{{ $endpoint['path'] ?? '' }}</span>
    </div>
    <span class="endpoint-auth {{ $isPublic ? 'public' : '' }}">{{ $auth }}</span>
  </div>

  <div class="endpoint-split">
    <!-- Left Column: Specs -->
    <div class="endpoint-docs">
      <p class="endpoint-description">{{ $endpoint['description'] ?? '' }}</p>

      @if(!empty($endpoint['parameters']))
        <div class="col-header">Request Parameters</div>
        <div class="param-list">
          @foreach($endpoint['parameters'] as $param)
            <div class="param-card">
              <div class="param-card-top">
                <div class="param-ident">
                  <span class="param-name mono">{{ $param['name'] ?? '' }}</span>
                  @if(!empty($param['type']))
                    <span class="param-type-chip mono">{{ $param['type'] }}</span>
                  @endif
                </div>
                @if(!empty($param['required']))
                  <span class="badge-req">required</span>
                @else
                  <span class="badge-opt">optional</span>
                @endif
              </div>

              @if(!empty($param['description']))
                <div class="param-desc">{{ $param['description'] }}</div>
              @endif

              @if(!empty($param['rules']) || !empty($param['default']))
                <div class="param-rules-row">
                  <span class="param-rule-label">Rules:</span>
                  @if(!empty($param['rules']))
                    @foreach((array)$param['rules'] as $rule)
                      <span class="rule-tag mono">{{ $rule }}</span>
                    @endforeach
                  @endif
                  @if(!empty($param['default']))
                    <span class="rule-tag mono">default: {{ $param['default'] }}</span>
                  @endif
                </div>
              @endif
            </div>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Right Column: Code Console -->
    <div class="endpoint-console">
      <div class="console-tabs">
        <div class="tab-group">
          @if(!empty($endpoint['request_body']))
            <button class="console-tab active" data-tab="{{ $reqTabId }}">Request Body</button>
          @endif

          @if(!empty($endpoint['responses']))
            @foreach($endpoint['responses'] as $idx => $res)
              @php
                $resTabId = 'res-' . $endpointId . '-' . $idx;
                $isFirstTab = empty($endpoint['request_body']) && $loop->first;
              @endphp
              <button class="console-tab {{ $isFirstTab ? 'active' : '' }}" data-tab="{{ $resTabId }}">
                {{ $res['label'] ?? ($res['status'] ?? 'Response') }}
              </button>
            @endforeach
          @endif
        </div>
        <button class="copy-btn" onclick="copyConsole(this)">Copy</button>
      </div>

      <div class="console-body">
        @if(!empty($endpoint['request_body']))
          <div class="tab-pane active" id="{{ $reqTabId }}">
<pre>{{ is_string($endpoint['request_body']) ? $endpoint['request_body'] : json_encode($endpoint['request_body'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
          </div>
        @endif

        @if(!empty($endpoint['responses']))
          @foreach($endpoint['responses'] as $idx => $res)
            @php
              $resTabId = 'res-' . $endpointId . '-' . $idx;
              $isFirstTab = empty($endpoint['request_body']) && $loop->first;
              $payload = $res['body'] ?? $res['content'] ?? [];
            @endphp
            <div class="tab-pane {{ $isFirstTab ? 'active' : '' }}" id="{{ $resTabId }}">
<pre>{{ is_string($payload) ? $payload : json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

