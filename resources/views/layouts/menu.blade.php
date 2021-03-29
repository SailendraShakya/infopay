<li class="c-sidebar-nav-item">
	<a class="c-sidebar-nav-link" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Home
    </a>
</li>

<li class="c-sidebar-nav-title">Products</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('products.index') }}">
        <i class="cib-justgiving"></i>&nbsp;&nbsp; Manual Products
    </a>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('scarping-listing') }}">
        <i class="cib-player-me"></i>&nbsp;&nbsp; Scraping Products
    </a>
</li>


<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('api-listing') }}">
        <i class="cib-strapi"></i>&nbsp;&nbsp; API Products
    </a>
</li>





<li class="c-sidebar-nav-title">Accounts</li>
<li class="c-sidebar-nav-item">
	<a class="c-sidebar-nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="c-icon mfe-2 cil-account-logout"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
</li>
