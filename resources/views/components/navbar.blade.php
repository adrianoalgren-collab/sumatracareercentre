<nav>
  <div class="nav-logo">
    Sistem Bursa Kerja - SCC Politeknik Caltex Riau
  </div>

  <ul class="nav-links" style="margin-top: 12px;">
    <li>
      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
        Beranda
      </a>
    </li>

   <li>
    <a href="{{ route('artikel') }}" 
    class="{{ request()->routeIs('artikel*') ? 'active' : '' }}">
        Artikel
    </a>
</li>

    <li>
      <a href="{{ route('lowongan.pekerjaan') }}" 
         class="{{ request()->routeIs('lowongan.pekerjaan') ? 'active' : '' }}">
        Lowongan
      </a>
    </li>

    <li>
      <a href="{{ route('about.us') }}" 
         class="{{ request()->routeIs('about.us') ? 'active' : '' }}">
        Tentang Kami
      </a>
    </li>

  </ul>

   @guest
<div class="nav-actions">
    <button class="btn-login" onclick="window.location.href='{{ route('login') }}'">
        Login
    </button>

    <button class="btn-primary" onclick="window.location.href='{{ route('register') }}'">
        Mulai Berkarir
    </button>
</div>
@endguest


@auth
<div class="nav-actions">

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-login">
            Logout
        </button>
    </form>

    <button class="btn-primary" onclick="window.location.href='{{ route('profil.saya') }}'">
        Profil Saya
    </button>

</div>
@endauth
</nav>