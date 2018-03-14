<form id="search-form" action="/search" method="GET">
    <div class="input-group">
        <input class="input-group-field" name="keywords" type="search" value="{{ \Request::get('keywords') }}" placeholder="I'm looking for..."/>
        <div class="input-group-button">
            <input type="submit" class="button dark" value="Search">
        </div>
    </div>
</form>