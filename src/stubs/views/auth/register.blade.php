@extends('voyager-frontend::layouts.default')

@section('content')
    <div class="grid-container">
        <div class="grid-x">
            <div class="form-title text-center">
                Register
            </div>

            <form class="register-form" method="POST" action="{{ route('register') }}">

                {{ csrf_field() }}

                <div class="name">
                    <label for="email">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" aria-describedby="nameHelpText" required autofocus>

                    @if (!empty($errors) && $errors->has('name'))
                        <span class="help-text" id="nameHelpText">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="email">
                    <label for="email">E-Mail Address</label>

                    <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required>

                    @if (!empty($errors) && $errors->has('email'))
                        <span class="help-text" id="emailHelpText">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="password">
                    <label for="password">Password</label>

                    <input id="password" type="password" name="password" aria-describedby="passwordHelpText" required>

                    @if (!empty($errors) && $errors->has('password'))
                        <span class="help-text" id="passwordHelpText">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="password-confirm">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>
                </div>

                <div class="register_button">
                    <button type="submit" class="button">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection