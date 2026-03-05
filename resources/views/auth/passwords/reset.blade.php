@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" onsubmit="return validatePassword()">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ $email ?? old('email') }}"
                                    required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required autocomplete="new-password"
                                    onkeyup="checkPasswordRules()">

                                <small class="text-muted">
                                    Must contain:
                                    1 uppercase letter,
                                    2 numbers,
                                    2 symbols,
                                    minimum 5 characters.
                                </small>

                                <small id="passwordError" class="text-danger"></small>

                                @error('password')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required autocomplete="new-password"
                                    onkeyup="checkConfirmPassword()">

                                <small id="confirmError" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkPasswordRules() {
        const password = document.getElementById("password").value;
        const error = document.getElementById("passwordError");

        const uppercase = (password.match(/[A-Z]/g) || []).length;
        const numbers = (password.match(/[0-9]/g) || []).length;
        const symbols = (password.match(/[^A-Za-z0-9]/g) || []).length;

        if (password.length < 5) {
            error.innerText = "Password must be at least 5 characters.";
        } else if (uppercase < 1) {
            error.innerText = "Password must contain at least 1 uppercase letter.";
        } else if (numbers < 2) {
            error.innerText = "Password must contain at least 2 numbers.";
        } else if (symbols < 2) {
            error.innerText = "Password must contain at least 2 symbols.";
        } else {
            error.innerText = "";
        }
    }

    function checkConfirmPassword() {
        const password = document.getElementById("password").value;
        const confirm = document.getElementById("password-confirm").value;
        const error = document.getElementById("confirmError");

        if (password !== confirm) {
            error.innerText = "Passwords do not match.";
        } else {
            error.innerText = "";
        }
    }

    function validatePassword() {
        checkPasswordRules();
        checkConfirmPassword();

        return (
            document.getElementById("passwordError").innerText === "" &&
            document.getElementById("confirmError").innerText === ""
        );
    }
</script>

@endsection