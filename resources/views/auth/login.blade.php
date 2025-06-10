<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SABAR</title>
    @include('auth.includes.style')
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('template/assets/images/logo/domba2.png') }}" 
                                 alt="Logo" 
                                 class="img-fluid move-left-tilt"
                                 style="width: 300px; height: auto;">
                        </a>
                    </div>
                    
                    <p class="auth-subtitle mb-5">Masukkan data login Anda yang telah terdaftar.</p>

                    {{-- ALERT --}}
                    @if(session('success'))
                        <div class="alert alert-light-success color-success">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-light-danger color-danger">
                            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-light-danger color-danger">
                            <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
                        </div>
                    @endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    {{-- Email --}}
<div class="form-group position-relative has-icon-left mb-4">
    <input type="email" name="email" class="form-control form-control-xl"
        placeholder="Email" value="{{ old('email') }}" required>
    <div class="form-control-icon">
        <i class="bi bi-envelope"></i>
    </div>
    @error('email')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>


    {{-- Password --}}
<div class="form-group position-relative has-icon-left mb-4">
    <input type="password" id="password" name="password" class="form-control form-control-xl"
        placeholder="Password" required>
    <div class="form-control-icon">
        <i class="bi bi-shield-lock"></i>
    </div>
    <span id="togglePassword" class="position-absolute top-50 end-0 translate-middle-y me-3"
        style="cursor: pointer;">
        <i class="bi bi-eye" id="togglePasswordIcon"></i>
    </span>
    @error('password')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>


    {{-- Ingat Saya --}}
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
        <label class="form-check-label" for="remember">Ingat Saya</label>
    </div>

    {{-- Tombol --}}
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
</form>


                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum Mempunyai Akun? <br>
                            <a href="{{ route('register') }}" class="font-bold">Registrasi</a>.
                        </p><br>
                        <p><a class="font-medium" href="#">Lupa Kata Sandi atau Password?</a></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
                @include('auth.includes.footer')
            </div>
        </div>
    </div>

    @include('auth.includes.script')
</body>
</html>
