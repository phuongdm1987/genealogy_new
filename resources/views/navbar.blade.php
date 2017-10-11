<!-- Navbar -->
<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar stacked-for-medium margin-bottom-1" id="responsive-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">Genealogy</li>
      <li><a href="{{ url('/') }}">Home</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      @guest
        <li>
          <a class="button small" href="{{ route('login') }}">Sign In</a>
        </li>
        <li class="margin-left-1">
          <a class="button small" href="{{ route('register') }}">Sign Up</a>
        </li>
      @endguest
      @auth
        <li class="">
          <a class="button small" href="{{ route('logout') }}">Sign Out</a>
        </li>
      @endauth
    </ul>
  </div>
</div>
<!-- End Navbar -->
