@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
  <fieldset class="fieldset">
    <legend>Sign Up</legend>
    <form method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}

      <label>Name
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
      </label>
      @if ($errors->has('name'))
        <p class="help-text">{{ $errors->first('name') }}</p>
      @endif

      <label>Email
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
      </label>
      @if ($errors->has('email'))
        <p class="help-text">{{ $errors->first('email') }}</p>
      @endif

      <label>Password
        <input id="password" name="password" type="password" value="{{ old('password') }}" required>
      </label>
      @if ($errors->has('password'))
        <p class="help-text">{{ $errors->first('password') }}</p>
      @endif

      <label>Confirm Password
        <input id="password-confirm" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" required>
      </label>

      <button type="submit" class="button primary expanded">Sign up</button>
    </form>
  </fieldset>
</div>
@endsection
