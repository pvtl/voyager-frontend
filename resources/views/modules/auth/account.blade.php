@extends('voyager-frontend::layouts.default')

@section('content')
    <form class="register-form" method="POST" action="{{ route('voyager-frontend.account') }}">
        @csrf

        <div class="grid-container">
            <div class="grid-x grid-padding-y">
                <div class="medium-6 medium-offset-3 cell email">
                    <h4 class="text-center">Update Account</h4>

                    @if (!empty(session('alert-type')))
                        <div class="callout small success text-center">
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif

                    @if (!empty($errors) && $errors->has('name'))
                        <div class="callout small alert text-center" id="nameHelpText">
                            <p>{{ $errors->first('name') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        Name
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" aria-describedby="nameHelpText" required autofocus>
                    </label>

                    @if (!empty($errors) && $errors->has('email'))
                        <div class="callout small alert text-center" id="emailHelpText">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        E-Mail Address
                        <input id="email" type="email" name="email" value="{{ $user->email }}" aria-describedby="emailHelpText" required>
                    </label>

                    @if (!empty($errors) && $errors->has('password'))
                        <div class="callout small alert text-center" id="passwordHelpText">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif

                    <label for="password">
                        Password
                        <input id="password" type="password" name="password" aria-describedby="passwordHelpText">
                    </label>

                    <label for="password-confirm">
                        Confirm Password
                        <input id="password-confirm" type="password" name="password_confirmation">
                    </label>

                    <button type="submit" class="button expanded">Update</button>
                </div>
            </div>
        </div>
    </form>
@endsection
