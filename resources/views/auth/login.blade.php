@extends('user_layouts.user_master')
@section('content')

<!-- breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
            <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
            <li class="active">Login Page</li>
        </ol>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- login -->
<div class="login">
    <div class="container">
        <h3 class="animated wow zoomIn" data-wow-delay=".5s">Login Form</h3>
        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
            <form method="POST" action="{{ route('login') }}">
                @csrf
               <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" 
                           placeholder="Email Address" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           placeholder="Password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <input type="submit" value="Login"
                            {{ __('Login') }}>
                        {{-- </input> --}}
                        <div class="forgot">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        </div>
                    @endif
            </form>


            {{-- <form>
                <input type="email" placeholder="Email Address" required=" " >
                <input type="password" placeholder="Password" required=" " >
                <div class="forgot">
                    <a href="#">Forgot Password?</a>
                </div>
                <input type="submit" value="Login">
            </form> --}}
        </div>
        <h4 class="animated wow slideInUp" data-wow-delay=".5s">For New People</h4>
        <p class="animated wow slideInUp" data-wow-delay=".5s"><a href="/register">Register Here</a> (Or) go back to <a href="/">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
    </div>
</div>
<!-- //login -->



    
@endsection