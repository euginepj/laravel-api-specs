<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $branding['title'] ?? 'API Specification' }}</title>
  <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --bg: #07090e;
      --surface: #0d111a;
      --surface-elevated: #131926;
      --surface-card: #0f1523;
      --border: #1e2638;
      --border-subtle: rgba(255, 255, 255, 0.05);
      --border-focus: #6366f1;
      
      --text-main: #f8fafc;
      --text-muted: #8492a6;
      --text-dim: #475569;
      
      --brand: #4f46e5;
      --brand-hover: #6366f1;
      --brand-glow: rgba(99, 102, 241, 0.15);
      
      --emerald: #10b981;
      --emerald-bg: rgba(16, 185, 129, 0.12);
      --emerald-border: rgba(16, 185, 129, 0.25);
      
      --amber: #f59e0b;
      --amber-bg: rgba(245, 158, 11, 0.12);
      --amber-border: rgba(245, 158, 11, 0.25);
      
      --rose: #f43f5e;
      --rose-bg: rgba(244, 63, 94, 0.12);
      --rose-border: rgba(244, 63, 94, 0.25);
      
      --cyan: #06b6d4;
      --cyan-bg: rgba(6, 182, 212, 0.12);
      --cyan-border: rgba(6, 182, 212, 0.25);
      
      --purple: #8b5cf6;
      --purple-bg: rgba(139, 92, 246, 0.12);
      
      --radius-sm: 6px;
      --radius-md: 10px;
      --radius-lg: 16px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      background: var(--bg);
      color: var(--text-main);
      line-height: 1.6;
      font-size: 14px;
      -webkit-font-smoothing: antialiased;
    }
    
    code, pre, .mono {
      font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, monospace;
    }

    a { color: var(--brand-hover); text-decoration: none; transition: color 0.15s ease; }
    a:hover { color: #818cf8; text-decoration: none; }

    /* Layout */
    .layout { display: flex; min-height: 100vh; }

    /* Sticky Sidebar */
    .sidebar {
      width: 320px;
      min-width: 320px;
      background: var(--surface);
      border-right: 1px solid var(--border);
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      z-index: 40;
    }

    .sidebar-header {
      padding: 24px 20px 20px;
      border-bottom: 1px solid var(--border);
      background: var(--surface);
      position: sticky;
      top: 0;
      z-index: 10;
    }
    .brand-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 3px 10px;
      border-radius: 9999px;
      background: var(--brand-glow);
      color: var(--brand-hover);
      border: 1px solid rgba(99, 102, 241, 0.3);
      font-size: 10.5px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-bottom: 10px;
    }
    .brand-title {
      font-size: 18px;
      font-weight: 800;
      letter-spacing: -0.02em;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .brand-logo-icon {
      width: 26px;
      height: 26px;
      color: var(--brand-hover);
    }
    .brand-subtitle {
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 4px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Sidebar Navigation */
    .sidebar-nav {
      padding: 16px 0 40px;
      flex: 1;
    }

    .nav-group {
      margin-bottom: 4px;
    }
    .nav-section-header {
      width: 100%;
      background: transparent;
      border: none;
      cursor: pointer;
      padding: 10px 18px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: #cbd5e1;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      text-align: left;
      border-radius: 8px;
      margin: 0 8px;
      width: calc(100% - 16px);
      transition: all 0.15s ease;
    }
    .nav-section-header:hover {
      background: rgba(255, 255, 255, 0.04);
      color: #fff;
    }
    .nav-section-title-wrap {
      display: flex;
      align-items: center;
      gap: 9px;
    }
    .nav-section-title-wrap span.num {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 20px;
      border-radius: 6px;
      background: rgba(255, 255, 255, 0.06);
      color: #94a3b8;
      font-size: 10px;
      font-weight: 800;
      transition: all 0.15s ease;
    }
    .nav-group.is-open .nav-section-title-wrap span.num {
      background: var(--brand);
      color: #fff;
      box-shadow: 0 0 12px rgba(79, 70, 229, 0.4);
    }
    .nav-section-header .chevron {
      width: 14px;
      height: 14px;
      color: var(--text-dim);
      transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-group.is-open .nav-section-header .chevron {
      transform: rotate(90deg);
      color: var(--brand-hover);
    }

    .nav-sub-items {
      display: none;
      padding: 4px 0 8px 8px;
    }
    .nav-group.is-open .nav-sub-items {
      display: block;
    }

    .nav-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 7px 18px 7px 28px;
      margin: 1px 8px;
      border-radius: 6px;
      color: var(--text-muted);
      font-size: 13px;
      font-weight: 500;
      transition: all 0.15s ease;
      position: relative;
    }
    .nav-item:hover {
      color: #fff;
      background: rgba(255, 255, 255, 0.03);
    }
    .nav-item.active {
      color: #fff;
      background: var(--brand-glow);
      font-weight: 600;
    }
    .nav-item.active::before {
      content: '';
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 14px;
      border-radius: 2px;
      background: var(--brand-hover);
    }

    /* Method Badges */
    .method-pill {
      font-size: 10px;
      font-weight: 800;
      padding: 2px 6px;
      border-radius: 4px;
      text-transform: uppercase;
      font-family: 'JetBrains Mono', monospace;
      letter-spacing: 0.04em;
    }
    .method-get { background: var(--emerald-bg); color: var(--emerald); border: 1px solid var(--emerald-border); }
    .method-post { background: var(--cyan-bg); color: var(--cyan); border: 1px solid var(--cyan-border); }
    .method-put { background: var(--amber-bg); color: var(--amber); border: 1px solid var(--amber-border); }
    .method-delete { background: var(--rose-bg); color: var(--rose); border: 1px solid var(--rose-border); }

    /* Content Area */
    .content {
      flex: 1;
      padding: 44px 56px;
      max-width: 1440px;
      overflow-x: hidden;
    }

    /* Hero Banner */
    .hero-banner {
      background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.15), transparent 50%),
                  linear-gradient(180deg, var(--surface) 0%, rgba(13, 17, 26, 0.6) 100%);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      padding: 36px 40px;
      margin-bottom: 48px;
      box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.5);
    }
    .hero-banner h1 {
      font-size: 30px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 10px;
      letter-spacing: -0.03em;
    }
    .hero-banner p {
      color: var(--text-muted);
      font-size: 14.5px;
      max-width: 780px;
      line-height: 1.65;
    }
    .hero-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 24px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.06);
    }
    .meta-box {
      font-size: 12px;
      color: var(--text-muted);
    }
    .meta-box strong {
      color: #e2e8f0;
      display: block;
      font-size: 13px;
      margin-bottom: 2px;
    }

    /* Section Titles */
    .section-block {
      margin-bottom: 64px;
      scroll-margin-top: 32px;
    }
    .section-title {
      font-size: 22px;
      font-weight: 800;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 8px;
      padding-bottom: 14px;
      border-bottom: 1px solid var(--border);
      letter-spacing: -0.02em;
    }
    .section-title span.badge-num {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      border-radius: 8px;
      background: var(--brand);
      color: #fff;
      font-size: 13px;
      font-weight: 800;
      box-shadow: 0 2px 10px rgba(79, 70, 229, 0.35);
    }
    .section-desc {
      color: var(--text-muted);
      font-size: 13.5px;
      margin-bottom: 26px;
    }

    /* 2-Column Split Endpoint Card */
    .endpoint-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      margin-bottom: 36px;
      overflow: hidden;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      scroll-margin-top: 36px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .endpoint-card:hover {
      border-color: rgba(99, 102, 241, 0.4);
      box-shadow: 0 6px 24px rgba(99, 102, 241, 0.08);
    }

    .endpoint-header {
      padding: 16px 24px;
      background: rgba(255, 255, 255, 0.015);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }
    .endpoint-path {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 15px;
      font-weight: 700;
      color: #fff;
    }
    .endpoint-auth {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      color: var(--amber);
      background: var(--amber-bg);
      border: 1px solid var(--amber-border);
      padding: 3px 9px;
      border-radius: 6px;
      font-weight: 700;
      letter-spacing: 0.02em;
    }
    .endpoint-auth.public {
      color: var(--emerald);
      background: var(--emerald-bg);
      border-color: var(--emerald-border);
    }

    /* 2-Column Grid */
    .endpoint-split {
      display: grid;
      grid-template-columns: 1.15fr 0.85fr;
      min-height: 400px;
    }
    @media (max-width: 1080px) {
      .endpoint-split {
        grid-template-columns: 1fr;
      }
    }

    /* Left: Specs & Schema */
    .endpoint-docs {
      padding: 24px 28px;
      border-right: 1px solid var(--border);
    }
    @media (max-width: 1080px) {
      .endpoint-docs {
        border-right: none;
        border-bottom: 1px solid var(--border);
      }
    }
    .endpoint-description {
      color: #cbd5e1;
      font-size: 13.5px;
      line-height: 1.6;
      margin-bottom: 22px;
    }

    .col-header {
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #94a3b8;
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    /* UI/UX Parameters Card Stack */
    .param-list {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    .param-card {
      background: rgba(15, 23, 42, 0.45);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      padding: 12px 14px;
      transition: all 0.15s ease;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .param-card:hover {
      background: rgba(255, 255, 255, 0.025);
      border-color: rgba(99, 102, 241, 0.25);
    }
    .param-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }
    .param-ident {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .param-name {
      font-size: 13.5px;
      font-weight: 700;
      color: #93c5fd;
      letter-spacing: -0.01em;
    }
    .param-type-chip {
      font-size: 11px;
      color: #38bdf8;
      background: rgba(56, 189, 248, 0.08);
      border: 1px solid rgba(56, 189, 248, 0.2);
      padding: 1px 6px;
      border-radius: 4px;
    }
    .badge-req {
      font-size: 9px;
      font-weight: 800;
      padding: 2px 6px;
      border-radius: 4px;
      color: #fff;
      background: #e11d48;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
    .badge-opt {
      font-size: 9px;
      font-weight: 600;
      padding: 2px 6px;
      border-radius: 4px;
      color: #94a3b8;
      background: rgba(255, 255, 255, 0.06);
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .param-desc {
      font-size: 13px;
      color: #cbd5e1;
      line-height: 1.5;
    }
    .param-rules-row {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 2px;
      padding-top: 6px;
      border-top: 1px dashed rgba(255, 255, 255, 0.04);
      font-size: 11px;
      color: #94a3b8;
    }
    .param-rule-label {
      font-size: 10.5px;
      font-weight: 700;
      color: #64748b;
      text-transform: uppercase;
      letter-spacing: 0.03em;
    }
    .rule-tag {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.07);
      padding: 1px 6px;
      border-radius: 4px;
      color: #e2e8f0;
      font-size: 11px;
    }

    /* Right: Code Console */
    .endpoint-console {
      background: #060911;
      display: flex;
      flex-direction: column;
    }
    .console-tabs {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255, 255, 255, 0.02);
      border-bottom: 1px solid var(--border);
      padding: 0 16px;
    }
    .tab-group {
      display: flex;
      gap: 4px;
    }
    .console-tab {
      background: transparent;
      border: none;
      color: var(--text-muted);
      padding: 11px 14px;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      transition: all 0.15s ease;
    }
    .console-tab:hover {
      color: #fff;
    }
    .console-tab.active {
      color: var(--brand-hover);
      border-bottom-color: var(--brand-hover);
    }
    .copy-btn {
      background: transparent;
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--text-muted);
      border-radius: 6px;
      padding: 4px 10px;
      font-size: 11px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      transition: all 0.15s ease;
    }
    .copy-btn:hover {
      background: rgba(255, 255, 255, 0.06);
      color: #fff;
      border-color: var(--brand-hover);
    }

    .console-body {
      padding: 20px;
      flex: 1;
      overflow-x: auto;
    }
    .tab-pane {
      display: none;
    }
    .tab-pane.active {
      display: block;
    }

    pre {
      background: transparent;
      font-size: 12.5px;
      color: #e2e8f0;
      line-height: 1.55;
      margin: 0;
      white-space: pre-wrap;
      word-break: break-all;
    }
  </style>
</head>
<body>
  @yield('content')

  <script>
    // Copy code snippet helper
    function copyConsole(button) {
      const consoleEl = button.closest('.endpoint-console');
      const activePane = consoleEl.querySelector('.tab-pane.active pre');
      if (!activePane) return;
      
      const textToCopy = activePane.innerText;
      navigator.clipboard.writeText(textToCopy).then(() => {
        const originalText = button.innerText;
        button.innerText = 'Copied!';
        button.style.borderColor = '#10b981';
        button.style.color = '#10b981';
        setTimeout(() => {
          button.innerText = originalText;
          button.style.borderColor = '';
          button.style.color = '';
        }, 1600);
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      // Tab switcher in console
      document.querySelectorAll('.console-tab').forEach(tab => {
        tab.addEventListener('click', () => {
          const tabGroup = tab.closest('.console-tabs');
          const consoleEl = tab.closest('.endpoint-console');
          const targetId = tab.getAttribute('data-tab');

          tabGroup.querySelectorAll('.console-tab').forEach(t => t.classList.remove('active'));
          consoleEl.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

          tab.classList.add('active');
          const targetPane = document.getElementById(targetId);
          if (targetPane) targetPane.classList.add('active');
        });
      });

      // Accordion click handling
      document.querySelectorAll('.nav-section-header').forEach(header => {
        header.addEventListener('click', (e) => {
          e.preventDefault();
          const group = header.closest('.nav-group');
          const isOpen = group.classList.contains('is-open');

          document.querySelectorAll('.nav-group').forEach(g => {
            if (g !== group) {
              g.classList.remove('is-open');
              g.querySelector('.nav-section-header')?.setAttribute('aria-expanded', 'false');
            }
          });

          if (isOpen) {
            group.classList.remove('is-open');
            header.setAttribute('aria-expanded', 'false');
          } else {
            group.classList.add('is-open');
            header.setAttribute('aria-expanded', 'true');
          }
        });
      });

      // Navigation Item Active State & Auto-expansion
      const navItems = document.querySelectorAll('.nav-item');
      navItems.forEach(item => {
        item.addEventListener('click', () => {
          navItems.forEach(n => n.classList.remove('active'));
          item.classList.add('active');

          const parentGroup = item.closest('.nav-group');
          if (parentGroup && !parentGroup.classList.contains('is-open')) {
            document.querySelectorAll('.nav-group').forEach(g => {
              g.classList.remove('is-open');
              g.querySelector('.nav-section-header')?.setAttribute('aria-expanded', 'false');
            });
            parentGroup.classList.add('is-open');
            parentGroup.querySelector('.nav-section-header')?.setAttribute('aria-expanded', 'true');
          }
        });
      });

      // Scroll Spy (IntersectionObserver)
      const cards = document.querySelectorAll('.endpoint-card');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = entry.target.id;
            const matchingLink = document.querySelector(`.nav-item[href="#${id}"]`);
            if (matchingLink) {
              navItems.forEach(n => n.classList.remove('active'));
              matchingLink.classList.add('active');

              const parentGroup = matchingLink.closest('.nav-group');
              if (parentGroup && !parentGroup.classList.contains('is-open')) {
                document.querySelectorAll('.nav-group').forEach(g => {
                  g.classList.remove('is-open');
                  g.querySelector('.nav-section-header')?.setAttribute('aria-expanded', 'false');
                });
                parentGroup.classList.add('is-open');
                parentGroup.querySelector('.nav-section-header')?.setAttribute('aria-expanded', 'true');
              }
            }
          }
        });
      }, {
        rootMargin: '-20% 0px -70% 0px',
        threshold: 0
      });

      cards.forEach(card => observer.observe(card));
    });
  </script>
</body>
</html>

