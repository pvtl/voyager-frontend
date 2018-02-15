@extends('voyager-frontend::layouts.default')

@section('content')
    <div class="grid-container">
        <div class="grid-x">
            <div class="status_message">
                @if (session('status'))
                    <div class="callout">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <div class="form-title text-center">
                Reset Password
            </div>

            <form class="forgot-password-form" method="POST" action="{{ route('password.email') }}">

                {{ csrf_field() }}

                <div class="email">
                    <label for="email">E-Mail Address</label>

                    <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required autofocus>

                    @if (!empty($errors) && $errors->has('email'))
                        <span class="help-text" id="emailHelpText">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="send-button">
                    <button type="submit" class="button">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection