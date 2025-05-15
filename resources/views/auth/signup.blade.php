<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - {{ config('app.name') }}</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="page-signup">
    <div class="container">
        <div class="auth-page-form">
            <div class="text-center mb-medium">
                <a href="/" class="logo-wrapper">
                    <img src="/img/Logo Web.png" alt="Logo" class="logo-img">
                </a>
            </div>

            <h1 class="auth-page-title">Daftar Akun</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="form-group">
                @csrf
                <div class="form-group">
                    <input type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Nama Lengkap" 
                           required />
                </div>

                <div class="form-group">
                    <input type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Email" 
                           required />
                </div>

                <div class="form-group">
                    <input type="password" 
                           name="password" 
                           placeholder="Password" 
                           required />
                </div>

                <div class="form-group">
                    <input type="password" 
                           name="password_confirmation" 
                           placeholder="Konfirmasi Password" 
                           required />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-signup w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <div class="text-center my-medium">
                <hr>
                <p class="login-text-dont-have-account">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-primary">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>

    @if(session('loading'))
    <div class="loading-container">
        <div class="loading">
            <svg class="loading-spinner" width="50" height="50" viewBox="0 0 24 24">
                <circle class="spinner" cx="12" cy="12" r="10" fill="none" stroke="#b17827" stroke-width="2"/>
            </svg>
            <p>Mohon tunggu...</p>
        </div>
    </div>
    @endif
</body>
</html>