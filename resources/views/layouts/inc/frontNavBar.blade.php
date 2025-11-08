<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm health-navbar">
    <div class="container">

        {{-- BRAND --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <span class="logo-pill d-inline-flex align-items-center justify-content-center me-2">
                <i class="fa-solid fa-notes-medical"></i>
            </span>
            <div class="d-flex flex-column lh-1">
                <span class="fw-bold text-uppercase brand-title">UPNKU Healthcare+</span>
                <small class="text-health-muted">E-Pharmacy &amp; Medical Supplies</small>
            </div>
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- NAV CONTENT --}}
        <div class="collapse navbar-collapse" id="navbarNav">

            {{-- LEFT LINKS --}}
            <ul class="navbar-nav ms-5">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('category*') ? 'active' : '' }}" href="{{ url('category') }}">
                        Kategori Kesehatan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('contact') }}">
                        Kontak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">
                        Tentang Kami
                    </a>
                </li>
            </ul>

            {{-- SEARCH DESKTOP --}}
            <div class="ms-auto me-3 d-none d-lg-block nav-search-wrap">
                <form class="d-flex" action="{{ url('searchProduct') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input name="product_name" required
                               type="search"
                               class="form-control nav-search-input"
                               placeholder="Cari obat, vitamin, alat kesehatan..."
                               aria-label="Search">
                        <button class="btn btn-health nav-search-btn" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

            {{-- AUTH / CART --}}
            <ul class="navbar-nav align-items-center">

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link nav-auth" href="{{ route('login') }}">
                                <i class="fa-regular fa-user me-1"></i> Login
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link nav-auth" href="{{ route('register') }}">
                                Daftar
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item me-2">
                        <a class="nav-link position-relative" href="{{ url('cart') }}">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown"
                           class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#" role="button" data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(31).webp"
                                 class="rounded-circle me-2" height="26" alt="User" loading="lazy">
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <span class="dropdown-item-text small text-muted">
                                {{ Auth::user()->email }}
                            </span>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ url('my-order') }}">
                                Riwayat Pesanan
                            </a>

                            <a class="dropdown-item"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}"
                                  method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>

            {{-- SEARCH MOBILE --}}
            <div class="w-100 mt-2 d-lg-none">
                <form class="d-flex" action="{{ url('searchProduct') }}" method="POST">
                    @csrf
                    <div class="input-group input-group-sm">
                        <input name="product_name" required
                               type="search"
                               class="form-control nav-search-input"
                               placeholder="Cari produk kesehatan..."
                               aria-label="Search">
                        <button class="btn btn-health px-3" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</nav>

{{-- STYLE KHUSUS NAVBAR HEALTHCARE --}}
<style>
    .health-navbar {
        background-color: #228e9b !important; /* SELALU solid gelap */
    }
   


    .logo-pill {
        width: 30px;
        height: 30px;
        border-radius: 999px;
        background: #00ffaeff;
        color: #0f172a;
        font-size: 14px;
    }

    .brand-title {
        font-size: 16px;
        letter-spacing: 0.08em;
    }

    .text-health-muted {
        color: #9ca3af;
    }

    .navbar {
        padding-top: 0.45rem;
        padding-bottom: 0.45rem;
    }

    .navbar .nav-link {
        font-size: 13px;
        font-weight: 500;
        color: #e5e7eb !important;
        transition: color 0.3s;
    }

    .navbar .nav-link.active,
    .navbar .nav-link:hover {
        color: #00ffaeff !important;
    }

    .nav-auth {
        padding-inline: 0.75rem;
    }

    .nav-search-wrap {
        max-width: 260px;
    }

    .nav-search-input {
        background-color: #111827;
        color: #ffffff;
        border: none;
        border-radius: 999px 0 0 999px !important;
        padding-left: 14px;
        font-size: 12px;
    }

    .nav-search-input::placeholder {
        color: #9ca3af;
    }

    .nav-search-btn {
        border-radius: 0 999px 999px 0 !important;
        background-color: #00ffaeff;
        color: #0f172a;
        border: none;
        padding-inline: 12px;
        font-size: 12px;
    }

    .nav-search-btn:hover {
        background-color: #00ffaeff ;
        color: #0f172a;
    }

    body {
        padding-top: 70px; /* supaya konten tidak ketutup navbar fixed-top */
    }
</style>
