<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">
                {{ setting('site.title') }}
            </li>
            {{ menu('primary', 'voyager-frontend::partials.main-menu') }}
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
        @if (Auth::check())
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endif
        </ul>
    </div>
</div>