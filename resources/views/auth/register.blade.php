@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
  <fieldset class="fieldset">
    <legend>Đăng ký</legend>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <label for="">
        <img class="thumbnail" id="image" style="max-width: 100%;" src="http://via.placeholder.com/150x150" alt="Avatar">
      </label>

      <label for="inputImage" class="button">Tải ảnh đại diện</label>
      <input type="file" name="avatar" id="inputImage" class="show-for-sr" value="{{ old('avatar') }}" accept=".jpg,.jpeg,.png">
      <input type="hidden" id="image_x" name="avatar_x" readonly="">
      <input type="hidden" id="image_y" name="avatar_y" readonly="">
      <input type="hidden" id="image_width" name="avatar_width" readonly="">
      <input type="hidden" id="image_height" name="avatar_height" readonly="">
      @if ($errors->has('avatar'))
        <p class="help-text">{{ $errors->first('avatar') }}</p>
      @endif

      <label>Họ và Tên
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
      </label>
      @if ($errors->has('name'))
        <p class="help-text">{{ $errors->first('name') }}</p>
      @endif


      <div>
        <input type="radio" name="sex" value="1" id="sexRed" {{ old('sex') == 1 ? "checked" : "" }} required><label for="sexRed">Nam</label>
        <input type="radio" name="sex" value="0" id="sexBlue" {{ old('sex') == 0 ? "checked" : "" }}><label for="sexBlue">Nữ</label>
      </div>

      <label>Email
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
      </label>
      @if ($errors->has('email'))
        <p class="help-text">{{ $errors->first('email') }}</p>
      @endif

      <label>Mật khẩu
        <input id="password" name="password" type="password" value="{{ old('password') }}" required>
      </label>
      @if ($errors->has('password'))
        <p class="help-text">{{ $errors->first('password') }}</p>
      @endif

      <label>Xác nhận mật khẩu
        <input id="password-confirm" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required>
      </label>

      <button type="submit" class="button primary expanded">Đăng ký</button>
    </form>
  </fieldset>
</div>
@endsection
