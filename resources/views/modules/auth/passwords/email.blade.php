@extends('voyager-frontend::layouts.default')

@section('content')
    <form class="forgot-password-form" method="POST" action="{{ route('password.email') }}">
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


                    @if (!empty($errors) && $errors->has('email'))
                        <div class="callout small alert text-center" id="emailHelpText">
                            <p>{{ $errors->first('email') }}</p>
                        </div>
                    @endif

                    <label for="email">
                        E-Mail Address
                        <input id="email" type="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelpText" required autofocus>
                    </label>

                    <button type="submit" class="button expanded">Send Password Reset Link</button>
                </div>
            </div>
        </div>
    </form>
@endsection
