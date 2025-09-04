@extends('layouts.front')

@section('title', 'Login')

@section('content')
<div class="page-login">
    <div class="login-card">
        <div class="login-header">
            <h4>Login</h4>
        </div>
        <div class="login-body">
            @if(session('status'))
                <div class="alert-success-valo mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-submit">Log in</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
