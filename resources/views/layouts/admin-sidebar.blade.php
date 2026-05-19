<nav id="sidebar" class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="bi bi-building"></i>
        </div>
        <span class="sidebar-brand-text">{{ config('app.name', 'MosqueCare') }}</span>
    </div>

    <div class="sidebar-nav">
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.jamaah.*') ? 'active' : '' }}" href="{{ route('admin.jamaah.index') }}">
                <i class="bi bi-people"></i>
                <span class="nav-text">Data Jamaah</span>
            </a>
        </div>

        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}" href="{{ route('admin.donations.index') }}">
                <i class="bi bi-cash-stack"></i>
                <span class="nav-text">Donasi</span>
            </a>
        </div>

        <div class="nav-item">
            <a class="nav-link submenu-toggle {{ request()->routeIs('admin.programs.*') || request()->routeIs('admin.reports.program') ? 'open' : '' }}" href="#">
                <i class="bi bi-folder"></i>
                <span class="nav-text">Program</span>
            </a>
            <div class="submenu {{ request()->routeIs('admin.programs.*') || request()->routeIs('admin.reports.program') ? 'open' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.programs.*') && !request()->routeIs('admin.programs.budgets.*') ? 'active' : '' }}" href="{{ route('admin.programs.index') }}">
                    <i class="bi bi-list-task"></i>
                    <span class="nav-text">Program Sosial</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.reports.program') ? 'active' : '' }}" href="{{ route('admin.reports.program') }}">
                    <i class="bi bi-file-text"></i>
                    <span class="nav-text">Laporan Program</span>
                </a>
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link submenu-toggle {{ request()->routeIs('admin.applications.*') || request()->routeIs('admin.distributions.*') ? 'open' : '' }}" href="#">
                <i class="bi bi-hand-thumbs-up"></i>
                <span class="nav-text">Bantuan</span>
            </a>
            <div class="submenu {{ request()->routeIs('admin.applications.*') || request()->routeIs('admin.distributions.*') ? 'open' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}">
                    <i class="bi bi-pencil-square"></i>
                    <span class="nav-text">Pengajuan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.distributions.*') ? 'active' : '' }}" href="{{ route('admin.distributions.index') }}">
                    <i class="bi bi-box-seam"></i>
                    <span class="nav-text">Distribusi</span>
                </a>
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link submenu-toggle {{ request()->routeIs('admin.reports.financial') || request()->routeIs('admin.reports.donation') || request()->routeIs('admin.reports.assistance') || request()->routeIs('admin.reports.index') ? 'open' : '' }}" href="#">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span class="nav-text">Laporan</span>
            </a>
            <div class="submenu {{ request()->routeIs('admin.reports.financial') || request()->routeIs('admin.reports.donation') || request()->routeIs('admin.reports.assistance') || request()->routeIs('admin.reports.index') ? 'open' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.reports.financial') ? 'active' : '' }}" href="{{ route('admin.reports.financial') }}">
                    <i class="bi bi-wallet2"></i>
                    <span class="nav-text">Keuangan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.reports.donation') ? 'active' : '' }}" href="{{ route('admin.reports.donation') }}">
                    <i class="bi bi-graph-up"></i>
                    <span class="nav-text">Donasi</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.reports.assistance') ? 'active' : '' }}" href="{{ route('admin.reports.assistance') }}">
                    <i class="bi bi-heart"></i>
                    <span class="nav-text">Bantuan</span>
                </a>
            </div>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div class="sidebar-footer-text">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-email">{{ Auth::user()->email }}</div>
        </div>
        <a href="{{ route('logout') }}" class="ms-auto text-white-50 text-decoration-none" title="Logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>

<button id="sidebarToggle" class="sidebar-toggle" title="Toggle sidebar">
    <i class="bi bi-chevron-left"></i>
</button>

<button id="sidebarMobileToggle" class="sidebar-mobile-toggle" title="Menu">
    <i class="bi bi-list"></i>
</button>

<div id="sidebarOverlay" class="sidebar-overlay"></div>
