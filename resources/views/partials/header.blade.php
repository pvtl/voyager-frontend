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
            <li><a href="/login">Login</a></li>
            <li><a href="/sign-up">Sign Up</a></li>
        </ul>
    </div>
</div>