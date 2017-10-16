@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
  <h4>Thêm mới Anh / Chị / Em</h4>
  <form method="POST" action="{{ route('siblings.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <fieldset class="fieldset">
      <legend>Anh / Chị / Em</legend>

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

      <label>Họ và tên
        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
      </label>
      @if ($errors->has('name'))
        <p class="help-text">{{ $errors->first('name') }}</p>
      @endif

      <div>
        <input type="radio" name="sex" value="1" id="sexRed" required><label for="sexRed">Nam</label>
        <input type="radio" name="sex" value="0" id="sexBlue"><label for="sexBlue">Nữ</label>
      </div>

      <label>Email
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
      </label>
      @if ($errors->has('email'))
        <p class="help-text">{{ $errors->first('email') }}</p>
      @endif

      <label>Ngày sinh
          <input id="dob" class="date-picker" name="dob" type="text" value="{{ old('dob') }}">
        </label>
        @if ($errors->has('dob'))
          <p class="help-text">{{ $errors->first('dob') }}</p>
        @endif

        <label for="is_dead">
          <input id="is_dead" class="show-elm" data-target="#contain_dod" name="is_dead" type="checkbox" value="1" {{ old('is_dead') ? 'checked' : '' }}>
          Đã mất
        </label>

        <div class="{{ old('is_dead') ? 'show' : 'hide' }}" id="contain_dod">
          <label>Ngày mất
            <input id="dod" class="date-picker" name="dod" type="text" value="{{ old('dod') }}">
          </label>
          @if ($errors->has('dod'))
            <p class="help-text">{{ $errors->first('dod') }}</p>
          @endif
        </div>
    </fieldset>

    <button type="submit" class="button primary expanded">Thêm mới</button>
  </form>
</div>
@endsection
