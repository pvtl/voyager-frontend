@extends('voyager-frontend::layouts.default')

@section('content')
    <form class="password-reset-form" method="POST" action="{{ route('password.request') }}">
        @csrf

        <div class="grid-container">
            <div class="grid-x grid-padding-y">
                <div class="medium-6 medium-offset-3 cell email">
                    <div class="status_message">
                        @if (session('status'))
                            <div class="callout">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                
                    <h4 class="text-center">Reset Password</h4>

                    <input type="hidden" name="token" value="{{ $token }}">

                    @if (!empty($errors) && $errors->has('email'))
                        <div class="callout small alert text-center" id="emailHelpText">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        E-Mail Address
                        <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required autofocus>
                    </label>

                    @if (!empty($errors) && $errors->has('password'))
                        <div class="callout small alert text-center" id="passwordHelpText">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif

                    <label for="password">
                        Password
                        <input id="password" type="password" name="password" aria-describedby="passwordHelpText" required>
                    </label>

                    @if (!empty($errors) && $errors->has('password'))
                        <div class="callout small alert text-center" id="passwordConfirmHelpText">
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    @endif

                    <label for="password-confirm">
                        Confirm Password
                        <input id="password-confirm" type="password" name="password_confirmation" aria-describedby="passwordConfirmHelpText" required>
                    </label>

                    <button type="submit" class="button expanded">Reset Password</button>
                </div>
            </div>
        </div>
    </form>
@endsection
