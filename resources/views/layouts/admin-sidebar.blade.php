<button class="sidebar-mobile-toggle" id="sidebarMobileToggle">
    <i class="bi bi-list"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<nav id="sidebar" class="sidebar">
    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">HT</div>
        <div class="sidebar-brand-text">
            HS Tax
            <small>Admin Panel</small>
        </div>
    </div>

    {{-- Navigation --}}
    <div class="sidebar-nav">
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span class="nav-text">Dashboard</span>
            </a>
        </div>

        {{-- CMS --}}
        <div class="nav-item">
            <a class="nav-link submenu-toggle {{ request()->routeIs('admin.cms.*') ? 'open' : '' }}" href="#"
               onclick="toggleSubmenu(this); return false;">
                <i class="bi bi-layout-text-window"></i>
                <span class="nav-text">Halaman Depan</span>
            </a>
            <div class="submenu {{ request()->routeIs('admin.cms.*') ? 'open' : '' }}">
                <a class="nav-link {{ request()->routeIs('admin.cms.index') ? 'active' : '' }}" href="{{ route('admin.cms.index') }}">
                    <i class="bi bi-dot"></i>
                    <span class="nav-text">Overview</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.cms.company') ? 'active' : '' }}" href="{{ route('admin.cms.company') }}">
                    <i class="bi bi-dot"></i>
                    <span class="nav-text">Profil Perusahaan</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.cms.contact') ? 'active' : '' }}" href="{{ route('admin.cms.contact') }}">
                    <i class="bi bi-dot"></i>
                    <span class="nav-text">Kontak</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.cms.social') ? 'active' : '' }}" href="{{ route('admin.cms.social') }}">
                    <i class="bi bi-dot"></i>
                    <span class="nav-text">Media Sosial</span>
                </a>
                <a class="nav-link {{ request()->routeIs('admin.cms.services') ? 'active' : '' }}" href="{{ route('admin.cms.services') }}">
                    <i class="bi bi-dot"></i>
                    <span class="nav-text">Layanan</span>
                </a>
            </div>
        </div>

        {{-- Packages --}}
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}" href="{{ route('admin.packages.index') }}">
                <i class="bi bi-box-seam"></i>
                <span class="nav-text">Paket</span>
            </a>
        </div>

        {{-- Testimonials --}}
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
                <i class="bi bi-star"></i>
                <span class="nav-text">Testimoni</span>
            </a>
        </div>

        {{-- FAQs --}}
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
                <i class="bi bi-question-circle"></i>
                <span class="nav-text">FAQ</span>
            </a>
        </div>

        {{-- News --}}
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                <i class="bi bi-newspaper"></i>
                <span class="nav-text">Berita</span>
            </a>
        </div>

        {{-- Comments --}}
        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}" href="{{ route('admin.comments.index') }}">
                <i class="bi bi-chat-dots"></i>
                <span class="nav-text">Komentar</span>
                @php $unread = \App\Models\Comment::where('is_approved', false)->count(); @endphp
                @if($unread > 0)
                    <span class="badge bg-warning text-dark ms-auto nav-text">{{ $unread }}</span>
                @endif
            </a>
        </div>
    </div>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <div class="sidebar-footer-text">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-email">{{ Str::limit(Auth::user()->email, 24) }}</div>
        </div>
        <a href="{{ route('logout') }}" class="ms-auto text-white-50 text-decoration-none"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</nav>

<button id="sidebarToggle" class="sidebar-toggle">
    <i class="bi bi-chevron-left" id="toggleIcon"></i>
</button>
