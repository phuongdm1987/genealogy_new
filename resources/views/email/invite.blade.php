<h1>Nhấp vào Liên kết để Xác minh Email của bạn</h1>

<p>Mật khẩu đăng nhập của bạn là: <b>{{ $password }}</b></p>
Nhấp vào liên kết sau để xác minh email của bạn <a href="{{route('verify', ['confirmation_code' => $confirmation_code])}}">{{route('verify', ['confirmation_code' => $confirmation_code])}}</a>
