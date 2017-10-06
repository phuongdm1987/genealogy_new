@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
  <fieldset class="fieldset">
    <legend>Sign In</legend>
    <form method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}

      <label>E-Mail Address
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

      <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}><label for="remember">Remember Me</label>

      <button type="submit" class="button primary expanded">Sign In</button>

      <div class="text-right">
        <a href="{{ route('password.request') }}">
          Forgot Your Password?
      </a>
      </div>
    </form>
  </fieldset>
</div>
@endsection
