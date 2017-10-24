<!-- Navbar -->
<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
  <div class="title-bar-title">Trình đơn</div>
</div>

<div class="top-bar stacked-for-medium margin-bottom-1" id="responsive-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">Gia phả</li>
      <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu dropdown" data-dropdown-menu>
      @guest
        <li>
          <a class="button small" href="{{ route('login') }}">Đăng nhập</a>
        </li>
        <li class="margin-left-1">
          <a class="button small" href="{{ route('register') }}">Đăng ký</a>
        </li>
      @endguest
      @auth
        <li>
          <a href="#">{{ auth()->user()->name }}</a>
          <ul class="menu vertical">
            <li><a href="{{ route('profile.index') }}">Cập nhật hồ sơ</a></li>
            <li><a href="{{ route('profile.change.password') }}">Cập nhật mật khẩu</a></li>
            <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
          </ul>
        </li>
      @endauth
    </ul>
  </div>
</div>
<!-- End Navbar -->
