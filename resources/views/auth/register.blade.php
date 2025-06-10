<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Peternak</title>
        @include('auth.includes.style')

</head>
<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo text-center mb-3">
                        <a href="{{ route('register') }}">
                            <img src="{{ asset('template/assets/images/logo/domba2.png') }}" alt="Logo" class="img-fluid" style="width: 100px;">
                        </a>
                    </div>
                    <p class="auth-subtitle mb-4 text-center">Daftarkan akun peternak Anda.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Username --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="name" class="form-control form-control-xl" placeholder="Username" value="{{ old('name') }}" required>
                            <div class="form-control-icon"><i class="bi bi-person-badge"></i></div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email" value="{{ old('email') }}" required>
                            <div class="form-control-icon"><i class="bi bi-envelope"></i></div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon"><i class="bi bi-lock"></i></div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Konfirmasi Password" required>
                            <div class="form-control-icon"><i class="bi bi-lock-fill"></i></div>
                        </div>

                        <hr>

                        {{-- Nama Lengkap --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="nama" class="form-control form-control-xl" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            <div class="form-control-icon"><i class="bi bi-person"></i></div>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="no_telp" class="form-control form-control-xl" placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required>
                            <div class="form-control-icon"><i class="bi bi-telephone"></i></div>
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group position-relative has-icon-left mb-3">
                            <textarea name="alamat" class="form-control form-control-xl" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                            <div class="form-control-icon"><i class="bi bi-geo-alt"></i></div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4" type="submit">Daftar</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold">Login di sini</a></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

        @include('auth.includes.script')

</body>
</html>
