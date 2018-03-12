@extends('voyager-frontend::layouts.default')

@section('content')
    <form class="register-form" method="POST" action="{{ route('register') }}">
        <div class="grid-container">
            <div class="grid-x grid-padding-y">
                <div class="medium-6 medium-offset-3 cell email">
                    <h4 class="text-center">Register</h4>

                    {{ csrf_field() }}

                    @if (!empty($errors) && $errors->has('name'))
                        <div class="callout small alert text-center" id="nameHelpText">
                            <p>{{ $errors->first('name') }}</strong>
                        </div>
                    @endif

                    <label for="email">
                        Name
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" aria-describedby="nameHelpText" required autofocus>
                    </label>

                    @if (!empty($errors) && $errors->has('email'))
                        <div class="callout small alert text-center" id="emailHelpText">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        E-Mail Address
                        <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required>
                    </label>

                    @if (!empty($errors) && $errors->has('password'))
                        <div class="callout small alert text-center" id="passwordHelpText">
                            <p>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif

                    <label for="password">
                        Password
                        <input id="password" type="password" name="password" aria-describedby="passwordHelpText" required>
                    </label>

                    <label for="password-confirm">
                        Confirm Password
                        <input id="password-confirm" type="password" name="password_confirmation" required>
                    </label>

                    <button type="submit" class="button expanded">Register</button>
                </div>
            </div>
        </div>
    </form>
@endsection