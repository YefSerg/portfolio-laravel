@props(['url'])

<a class="nav-link" data-widget="navbar-search" href="{{ $url }}" role="button">
    <i class="fas fa-search"></i>
</a>
<div class="navbar-search-block">
    <form action="{{ $url }}" class="form-inline" method="GET">
        <div class="input-group input-group-sm">
            <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search"
                   aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </form>
</div>
