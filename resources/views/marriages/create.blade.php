@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <h4>Add new marriage</h4>
  <form method="POST" action="{{ route('marriages.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="grid-x grid-padding-x">
      <div class="cell medium-4">
        <fieldset class="fieldset">
          <legend>Marriage</legend>
          <label>Begin
            <input id="started_at" class="date-picker" name="marriage[started_at]" type="text" value="{{ old('marriage.started_at') }}" required>
          </label>
          @if ($errors->has('marriage.started_at'))
            <p class="help-text">{{ $errors->first('marriage.started_at') }}</p>
          @endif

          <label for="is_ended">
            <input id="is_ended" class="show-elm" name="marriage[is_ended]" type="checkbox" value="1" {{ old('marriage.is_ended') ? 'checked' : '' }}>
            Game over
          </label>

          <div class="{{ old('marriage.is_ended') ? 'show' : 'hide' }} show-by">
            <label>End
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
          <legend>{{ $user->isMan() ? 'Wife' : 'Husband' }}</legend>

          <label for="avatar" class="button">Upload File</label>
          <input type="file" name="avatar" id="avatar" class="show-for-sr">

          <label>Name
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
        </fieldset>
      </div>
    </div>

    <button type="submit" class="button primary expanded">Add new</button>
  </form>
</div>
@endsection
