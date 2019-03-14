        <footer class="top-footer">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell medium-4 text-center medium-text-left">
                        <h6>Sign up for our newsletter</h6>
                        <div class="input-group">
                            <input class="input-group-field" type="email" placeholder="Email address">
                            <div class="input-group-button">
                                <input type="submit" class="button light" value="Submit">
                            </div> <!-- /.input-group-button -->
                        </div> <!-- /.input-group -->
                    </div> <!-- /.cell -->

                    <div class="vertical-space show-for-small-only"></div>

                    <div class="cell medium-6 medium-offset-2 text-center medium-text-right">
                        <h6>Connect with us</h6>
                        <ul class="menu social-icons align-center">
                            {{ menu('social', 'voyager-frontend::partials.social') }}
                        </ul>
                    </div> <!-- /.cell -->
                </div> <!-- /.grid -->
            </div> <!-- /.grid-container -->
        </footer>

        <footer class="bottom-footer">
            <div class="grid-container">
                <div class="grid-x grid-padding-y">
                    <div class="cell small-12">
                        <ul class="menu align-center">
                            {{ menu('primary', 'voyager-frontend::partials.menu-left') }}
                        </ul>

                        <p class="copyright text-center">&copy; {{ setting('site.title') }} @php echo date('Y'); @endphp. All rights reserved.</p>
                    </div> <!-- /.cell -->
                </div> <!-- /.grid -->
            </div> <!-- /.grid-container -->
        </footer>
    </div> <!-- /.off-canvas-content -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="{{ url('/') }}/js/app.js"></script>
</body>
</html>
