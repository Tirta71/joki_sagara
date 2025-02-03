<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">
                        Log in with your data that you entered during registration.
                    </p>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl"
                                placeholder="Enter your email" required />
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password" required />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Log in
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-black">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold">Sign up</a>.
                        </p>
                        <p>
                            <a href="{{ route('password.request') }}" class="font-bold">Forgot your password?</a>
                        </p>
                    </div>
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
