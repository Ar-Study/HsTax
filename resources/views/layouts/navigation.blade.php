<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #1b4332 0%, #2d6a4f 100%);">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('jamaah.dashboard') }}">
            <i class="bi bi-building"></i> {{ config('app.name', 'MosqueCare') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jamaah.dashboard') ? 'active' : '' }}" href="{{ route('jamaah.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jamaah.applications.*') ? 'active' : '' }}" href="{{ route('jamaah.applications.index') }}">
                        <i class="bi bi-pencil-square"></i> Pengajuan Bantuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jamaah.profile.*') ? 'active' : '' }}" href="{{ route('jamaah.profile.edit') }}">
                        <i class="bi bi-person"></i> Profil Saya
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text text-muted small">{{ Auth::user()->email }}</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
