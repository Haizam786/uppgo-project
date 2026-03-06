@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateRegisterForm()" autocomplete="off">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_category" class="col-md-4 col-form-label text-md-end">User Category</label>

                            <div class="col-md-6">
                                <select id="user_category"
                                    name="user_category"
                                    class="form-control @error('user_category') is-invalid @enderror"
                                    required>
                                    <option value="">Select category</option>
                                    <option value="nation" {{ old('user_category') == 'nation' ? 'selected' : '' }}>Nation</option>
                                    <option value="non_nation" {{ old('user_category') == 'non_nation' ? 'selected' : '' }}>Non Nation</option>
                                </select>

                                @error('user_category')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Event Interests</label>

                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">
                                    Choose your interests from highest to lowest. At least 1 is required.
                                </small>

                                <select name="interest_1" id="interest_1" class="form-control mb-2 interest-select" required>
                                    <option value="">1st Priority (Highest)</option>
                                    <option value="Food" {{ old('interest_1') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Sports" {{ old('interest_1') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('interest_1') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Art" {{ old('interest_1') == 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Technology" {{ old('interest_1') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Networking" {{ old('interest_1') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                </select>

                                <select name="interest_2" id="interest_2" class="form-control mb-2 interest-select">
                                    <option value="">2nd Priority</option>
                                    <option value="Food" {{ old('interest_2') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Sports" {{ old('interest_2') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('interest_2') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Art" {{ old('interest_2') == 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Technology" {{ old('interest_2') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Networking" {{ old('interest_2') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                </select>

                                <select name="interest_3" id="interest_3" class="form-control mb-2 interest-select">
                                    <option value="">3rd Priority</option>
                                    <option value="Food" {{ old('interest_3') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Sports" {{ old('interest_3') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('interest_3') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Art" {{ old('interest_3') == 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Technology" {{ old('interest_3') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Networking" {{ old('interest_3') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                </select>

                                <select name="interest_4" id="interest_4" class="form-control mb-2 interest-select">
                                    <option value="">4th Priority</option>
                                    <option value="Food" {{ old('interest_4') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Sports" {{ old('interest_4') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('interest_4') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Art" {{ old('interest_4') == 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Technology" {{ old('interest_4') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Networking" {{ old('interest_4') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                </select>

                                <select name="interest_5" id="interest_5" class="form-control interest-select">
                                    <option value="">5th Priority (Lowest)</option>
                                    <option value="Food" {{ old('interest_5') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Sports" {{ old('interest_5') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('interest_5') == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Art" {{ old('interest_5') == 'Art' ? 'selected' : '' }}>Art</option>
                                    <option value="Technology" {{ old('interest_5') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                    <option value="Networking" {{ old('interest_5') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                </select>

                                @error('event_interests')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <small id="interestError" class="text-danger d-block mt-1"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password"
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    onkeyup="checkPasswordRules(event); checkConfirmPassword();"
                                    onkeydown="checkCapsLock(event)"
                                    onblur="hideCapsLockWarning()">

                                <small class="text-muted">
                                    Must contain at least 8 characters, 2 uppercase letters, 2 numbers, and 2 symbols.
                                </small>

                                <small id="capsLockWarning" class="text-warning d-block"></small>
                                <small id="passwordError" class="text-danger d-block"></small>

                                @error('password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                {{ __('Confirm Password') }}
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    onkeyup="checkConfirmPassword(); checkCapsLock(event)"
                                    onkeydown="checkCapsLock(event)"
                                    onblur="hideCapsLockWarning()">

                                <small id="confirmError" class="text-danger d-block"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
function checkCapsLock(event)
{
    const capsWarning = document.getElementById("capsLockWarning");

    if (event && event.getModifierState && event.getModifierState("CapsLock")) {
        capsWarning.innerText = "Caps Lock is ON";
    } else {
        capsWarning.innerText = "";
    }
}

function hideCapsLockWarning()
{
    document.getElementById("capsLockWarning").innerText = "";
}

function checkPasswordRules(event)
{
    checkCapsLock(event);

    const password = document.getElementById("password").value;
    const error = document.getElementById("passwordError");

    const uppercase = (password.match(/[A-Z]/g) || []).length;
    const numbers = (password.match(/[0-9]/g) || []).length;
    const symbols = (password.match(/[^A-Za-z0-9]/g) || []).length;

    if (password.length < 8) {
        error.innerText = "Password must be at least 8 characters.";
    }
    else if (uppercase < 2) {
        error.innerText = "Password must contain at least 2 uppercase letters.";
    }
    else if (numbers < 2) {
        error.innerText = "Password must contain at least 2 numbers.";
    }
    else if (symbols < 2) {
        error.innerText = "Password must contain at least 2 symbols.";
    }
    else {
        error.innerText = "";
    }
}

function checkConfirmPassword()
{
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("password-confirm").value;
    const error = document.getElementById("confirmError");

    if (confirm !== "" && password !== confirm) {
        error.innerText = "Passwords do not match.";
    } else {
        error.innerText = "";
    }
}

function validateInterests()
{
    const selects = document.querySelectorAll('.interest-select');
    const values = [];
    const error = document.getElementById("interestError");

    for (let i = 0; i < selects.length; i++) {
        const val = selects[i].value.trim();
        if (val !== "") {
            values.push(val);
        }
    }

    if (values.length < 1) {
        error.innerText = "Please select at least 1 event interest.";
        return false;
    }

    const uniqueValues = [...new Set(values)];
    if (values.length !== uniqueValues.length) {
        error.innerText = "Please do not select the same interest more than once.";
        return false;
    }

    error.innerText = "";
    return true;
}

function validateRegisterForm()
{
    checkPasswordRules();
    checkConfirmPassword();

    return (
        document.getElementById("passwordError").innerText === "" &&
        document.getElementById("confirmError").innerText === "" &&
        validateInterests()
    );
}
</script>
@endsection