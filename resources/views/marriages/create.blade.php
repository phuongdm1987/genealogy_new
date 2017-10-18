@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <h4>Thêm mới Hôn nhân</h4>
  <form method="POST" action="{{ route('marriages.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="grid-x grid-padding-x">
      <div class="cell medium-4">
        <fieldset class="fieldset">
          <legend>Hôn nhân</legend>
          <label>Bắt đầu
            <input id="started_at" class="date-picker" name="marriage[started_at]" type="text" value="{{ old('marriage.started_at') }}" required>
          </label>
          @if ($errors->has('marriage.started_at'))
            <p class="help-text">{{ $errors->first('marriage.started_at') }}</p>
          @endif

          <label for="is_ended">
            <input id="is_ended" class="show-elm" data-target="#contain_ended_at" name="marriage[is_ended]" type="checkbox" value="1" {{ old('marriage.is_ended') ? 'checked' : '' }}>
            Đã ly hôn
          </label>

          <div class="{{ old('marriage.is_ended') ? 'show' : 'hide' }}" id="contain_ended_at">
            <label>Kết thúc
              <input id="ended_at" class="date-picker" name="marriage[ended_at]" type="text" value="{{ old('marriage.ended_at') }}">
            </label>
            @if ($errors->has('marriage.ended_at'))
              <p class="help-text">{{ $errors->first('marriage.ended_at') }}</p>
            @endif
          </div>

        </fieldset>
      </div>
      <div class="cell medium-8">
        <fieldset class="fieldset">
          <legend>{{ $user->isMan() ? 'Vợ' : 'Chồng' }}</legend>

          <label for="">
            <img class="thumbnail" id="image" style="max-width: 100%;" src="http://via.placeholder.com/150x150" alt="Avatar">
          </label>

          <label for="inputImage" class="button">Tải ảnh đại diện</label>
          <input type="file" name="user[avatar]" id="inputImage" class="show-for-sr" value="{{ old('user.avatar') }}" accept=".jpg,.jpeg,.png">
          <input type="hidden" id="image_x" name="user[avatar_x]" readonly="">
          <input type="hidden" id="image_y" name="user[avatar_y]" readonly="">
          <input type="hidden" id="image_width" name="user[avatar_width]" readonly="">
          <input type="hidden" id="image_height" name="user[avatar_height]" readonly="">
          @if ($errors->has('user.avatar'))
            <p class="help-text">{{ $errors->first('user.avatar') }}</p>
          @endif

          <label>Họ và tên
            <input id="name" name="user[name]" type="text" value="{{ old('user.name') }}" required>
          </label>
          @if ($errors->has('user.name'))
            <p class="help-text">{{ $errors->first('user.name') }}</p>
          @endif

          <label>Email
            <input id="email" name="user[email]" type="email" value="{{ old('user.email') }}" required>
          </label>
          @if ($errors->has('user.email'))
            <p class="help-text">{{ $errors->first('user.email') }}</p>
          @endif

          <label>Ngày sinh
            <input id="dob" class="date-picker" name="user[dob]" type="text" value="{{ old('user.dob') }}">
          </label>
          @if ($errors->has('user.dob'))
            <p class="help-text">{{ $errors->first('user.dob') }}</p>
          @endif

          <label for="is_dead">
            <input id="is_dead" class="show-elm" data-target="#contain_dod" name="user[is_dead]" type="checkbox" value="1" {{ old('user.is_dead') ? 'checked' : '' }}>
            Đã mất
          </label>

          <div class="{{ old('user.is_dead') ? 'show' : 'hide' }}" id="contain_dod">
            <label>Ngày mất
              <input id="dod" class="date-picker" name="user[dod]" type="text" value="{{ old('user.dod') }}">
            </label>
            @if ($errors->has('user.dod'))
              <p class="help-text">{{ $errors->first('user.dod') }}</p>
            @endif
          </div>
        </fieldset>
      </div>
    </div>

    <button type="submit" class="button primary expanded">Thêm mới</button>
  </form>
</div>
@endsection
