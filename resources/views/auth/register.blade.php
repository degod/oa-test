@extends('auth.layout')
@section('page', "Register")

@section('auth-form')
<div class="login-form">
    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}">
            @error('name') <div class="text-danger text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
            @error('email') <div class="text-danger text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Enter Password">
            @error('password') <div class="text-danger text-xs">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Re-enter Password">
            @error('password_confirmation') <div class="text-danger text-xs">{{ $message }}</div> @enderror
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('login.form') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection