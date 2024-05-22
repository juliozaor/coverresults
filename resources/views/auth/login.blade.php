{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}

 {{-- @extends('layouts.app') --}}





 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="{{ asset('assets/js/color-modes.js') }}"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.118.2">
        <title>Guardian Track by Covert Results</title>
        <link rel="icon" type="image/png" sizes="48x48" href="../assets/dist/img/favicon.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
        <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/dist/css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased"> @if (Auth::check())
        @include('includes.auth_menu')
     @else
        @include('includes.guestt_menu')
     @endif

     
<main class="flex-shrink-0">
    <div class="banner-map2" id="top">
        <div class="w-100 backpage mx-auto">
            <div class="spacer100"></div>
            <div class="container my-5">
                <div class="row justify-content-md-center row-cols-1 row-cols-lg-2 g-2 g-lg-4">
                    <div class="col equal">
                        <div class="w-100 table-container">
                            <div class="px-3 my-5">
                                <h2>Login</h2>
                                <p class="text-muted">Please enter your data to access</p>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill" id="submitButton">
                                        {{ __('Login') }}
                                    </button>
                                    <p class="my-5">Forgot your password? <a href="{{ route('password.request') }}">Recover it here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="bg-dark text-white">
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-3 py-5 my-5">
            <div class="col mb-3 text-center">
                <a href="{{ url('/') }}" class="mb-3 link-body-emphasis text-decoration-none">
                    <img class="img-fluid" width="180px" src="{{ asset('assets/dist/img/logo-dark.svg') }}" />
                </a>
                <p class="text-white">© 2024 Covert Results</p>
            </div>
            <div class="col mb-3 text-center">
                <h5>COVERT RESULTS</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">41 Peabody St. Nashville, TN 37210</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">(615) 861-1680</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">contact@covertresults.com</a></li>
                </ul>
            </div>
            <div class="col mb-3 text-center">
                <h5>MORE INFO</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Terms</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('login') }}" class="nav-link p-0 text-white">Login</a></li>
                </ul>
            </div>
        </footer>
    </div>
</div>
</body>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
</html>
