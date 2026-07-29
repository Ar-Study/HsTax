<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — HS Tax Admin</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    @auth
    <button class="sidebar-mobile-toggle" id="mobileToggle" onclick="toggleMobileSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleMobileSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">HT</div>
            <div class="sidebar-brand-text">
                HS Tax
                <small>Admin Panel</small>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                {{-- CMS --}}
                <li class="nav-item">
                    <div class="nav-link submenu-toggle {{ request()->routeIs('admin.cms.*') ? 'open' : '' }}"
                         onclick="toggleSubmenu(this)">
                        <i class="bi bi-layout-text-window"></i>
                        <span class="nav-text">Halaman Depan</span>
                    </div>
                    <ul class="submenu nav flex-column {{ request()->routeIs('admin.cms.*') ? 'open' : '' }}">
                        <li><a href="{{ route('admin.cms.index') }}" class="nav-link {{ request()->routeIs('admin.cms.index') ? 'active' : '' }}"><i class="bi bi-dot"></i><span class="nav-text">Overview</span></a></li>
                        <li><a href="{{ route('admin.cms.company') }}" class="nav-link {{ request()->routeIs('admin.cms.company') ? 'active' : '' }}"><i class="bi bi-dot"></i><span class="nav-text">Profil Perusahaan</span></a></li>
                        <li><a href="{{ route('admin.cms.contact') }}" class="nav-link {{ request()->routeIs('admin.cms.contact') ? 'active' : '' }}"><i class="bi bi-dot"></i><span class="nav-text">Kontak</span></a></li>
                        <li><a href="{{ route('admin.cms.social') }}" class="nav-link {{ request()->routeIs('admin.cms.social') ? 'active' : '' }}"><i class="bi bi-dot"></i><span class="nav-text">Media Sosial</span></a></li>
                        <li><a href="{{ route('admin.cms.services') }}" class="nav-link {{ request()->routeIs('admin.cms.services') ? 'active' : '' }}"><i class="bi bi-dot"></i><span class="nav-text">Layanan</span></a></li>
                    </ul>
                </li>

                {{-- Packages --}}
                <li class="nav-item">
                    <a href="{{ route('admin.packages.index') }}"
                       class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i>
                        <span class="nav-text">Paket</span>
                    </a>
                </li>

                {{-- Testimonials --}}
                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="bi bi-star"></i>
                        <span class="nav-text">Testimoni</span>
                    </a>
                </li>

                {{-- FAQs --}}
                <li class="nav-item">
                    <a href="{{ route('admin.faqs.index') }}"
                       class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                        <i class="bi bi-question-circle"></i>
                        <span class="nav-text">FAQ</span>
                    </a>
                </li>

                {{-- News --}}
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}"
                       class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span class="nav-text">Berita</span>
                    </a>
                </li>

                {{-- Comments --}}
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}"
                       class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots"></i>
                        <span class="nav-text">Komentar</span>
                        @php $unread = \App\Models\Comment::whereNull('approved_at')->count(); @endphp
                        @if($unread > 0)
                            <span class="badge bg-warning text-dark ms-auto nav-text">{{ $unread }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Footer --}}
        <div class="sidebar-footer">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="sidebar-footer-text">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email" title="{{ Auth::user()->email }}">{{ Str::limit(Auth::user()->email, 22) }}</div>
            </div>
            <a href="{{ route('logout') }}" class="ms-auto text-white-50 text-decoration-none"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right" title="Logout"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </aside>

    <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
        <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </button>
    @endauth

    <main class="main-content">
        @auth
        <div class="container-fluid py-3 px-4">
            {{-- Page Header --}}
            @hasSection('page-header')
                <div class="mb-4">
                    <h4 class="mb-1 fw-bold">@yield('page-header')</h4>
                    @hasSection('page-description')
                        <p class="text-muted mb-0 small">@yield('page-description')</p>
                    @endif
                </div>
            @endif

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
        @endauth

        <div class="@auth container-fluid px-4 pb-4 @endauth">
            @yield('content')
        </div>
    </main>

    @stack('scripts')

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            const icon = document.getElementById('toggleIcon');
            icon.classList.toggle('bi-chevron-left');
            icon.classList.toggle('bi-chevron-right');
        }

        function toggleMobileSidebar() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function toggleSubmenu(el) {
            el.classList.toggle('open');
            const submenu = el.nextElementSibling;
            if (submenu) submenu.classList.toggle('open');
        }

        // Preserve sidebar state
        if (localStorage.getItem('sidebar-collapsed') === 'true') {
            document.getElementById('sidebar')?.classList.add('collapsed');
        }
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            const collapsed = document.getElementById('sidebar').classList.contains('collapsed');
            localStorage.setItem('sidebar-collapsed', collapsed);
        });
    </script>
</body>
</html>
