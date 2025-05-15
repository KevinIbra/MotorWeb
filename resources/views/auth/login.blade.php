<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="page-login">
    <div class="container">
        <div class="auth-page-form">
            <div class="text-center mb-medium">
                <a href="/" class="logo-wrapper">
                    <img src="/img/Logo Web.png" alt="Logo" class="logo-img">
                </a>
            </div>

            <h1 class="auth-page-title">Masuk ke Akun</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="form-group">
                @csrf
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
                    <label class="checkbox">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-login w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; margin-right: 4px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Masuk
                    </button>
                </div>
            </form>

            <div class="text-center my-medium">
                <hr>
                <p class="login-text-dont-have-account">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-primary">
                        Daftar di sini
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
