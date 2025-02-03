<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/compiled/css/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/compiled/css/auth.css') }}" />
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Forgot Password</h1>
                    <p class="auth-subtitle mb-5">
                        Enter your email to receive a password reset link.
                    </p>
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        {{-- Name --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="name" class="form-control form-control-xl"
                                placeholder="Enter your full name" required />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl"
                                placeholder="Enter your email" required />
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        {{-- Old password --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="old_password" class="form-control form-control-xl"
                                placeholder="Enter your old password" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        {{-- New Password --}}
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="new_password" class="form-control form-control-xl"
                                placeholder="Enter your new password" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Reset Password
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}"><img src="./assets/compiled/png/logo.png" alt="Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
