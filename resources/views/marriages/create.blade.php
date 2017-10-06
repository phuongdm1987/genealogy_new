@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <h4>Thêm mới hôn nhân</h4>
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
            <input id="is_ended" class="show-elm" name="marriage[is_ended]" type="checkbox" value="1" {{ old('marriage.is_ended') ? 'checked' : '' }}>
            Đã ly hôn
          </label>

          <div class="{{ old('marriage.is_ended') ? 'show' : 'hide' }} show-by">
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
            <img class="thumbnail" id="image" src="http://via.placeholder.com/150x150" alt="Avatar">
          </label>

          <label for="file" class="button">Tải ảnh đại diện</label>
          <input type="file" name="user[avatar]" id="file" class="show-for-sr" value="{{ old('user.avatar') }}">
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

          <label>Ngày mất
            <input id="dod" class="date-picker" name="user[dod]" type="text" value="{{ old('user.dod') }}">
          </label>
          @if ($errors->has('user.dod'))
            <p class="help-text">{{ $errors->first('user.dod') }}</p>
          @endif
        </fieldset>
      </div>
    </div>

    <button type="submit" class="button primary expanded">Thêm mới</button>
  </form>
</div>
@endsection
