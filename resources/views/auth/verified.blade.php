@extends('layout', ['sidebar' => false])

@section('content')
<fieldset class="fieldset">
  <legend>Verification</legend>
  Your Email is successfully verified. Click here to <a href="{{ route('login') }}">login</a>
</fieldset>
@endsection
