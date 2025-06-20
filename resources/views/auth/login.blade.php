@extends('auth.layout')
@section('page', "Login")

@section('auth-form')
<div class="login-form">
    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{ route('register.form') }}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection