@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <fieldset class="fieldset">
    <legend>Hồ sơ cá nhân</legend>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <label for="">
        <img class="thumbnail" id="image" style="max-width: 100%;" src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
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
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus>
      </label>
      @if ($errors->has('name'))
        <p class="help-text">{{ $errors->first('name') }}</p>
      @endif

      <label>Email
        <input id="email" type="email" value="{{ old('email', $user->email) }}" disabled>
      </label>

      <label>Điện thoại
        <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" required>
      </label>
      @if ($errors->has('phone'))
        <p class="help-text">{{ $errors->first('phone') }}</p>
      @endif

      <label>Ngày sinh
          <input id="dob" class="date-picker" name="dob" type="text" value="{{ old('dob', $user->getDob('Y-m-d')) }}">
        </label>
        @if ($errors->has('dob'))
          <p class="help-text">{{ $errors->first('dob') }}</p>
        @endif

      <button type="submit" class="button primary expanded">Cập nhật</button>
    </form>
  </fieldset>
</div>
@endsection
