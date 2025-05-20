<header class="navbar">
    <div class="container navbar-content">
        <div class="navbar-left">
            <a href="/" class="logo-wrapper">
                <img src="/img/Logo Web.png" alt="Logo" class="logo-img">
            </a>
        </div>

        <div class="navbar-right">
            @auth
                <div class="navbar-menu" tabindex="-1">
                    <a href="javascript:void(0)" class="navbar-menu-handler">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="submenu">
                        @if(auth()->user()->role === 'admin')
                            <li><a href="{{ route('motor.mylist') }}">MotorKU</a></li>
                        @else
                            <li><a href="{{ route('motor.favorites') }}">Motor Favorit</a></li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="btn-logout">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('motor.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Motor
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-signup">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Daftar
                </a>
            @endauth
        </div>
    </div>
</header>