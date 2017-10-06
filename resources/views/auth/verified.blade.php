@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
    <fieldset class="fieldset">
      <legend>Verification</legend>
      Your Email is successfully verified. Click here to <a href="{{ route('login') }}">login</a>
    </fieldset>
</div>
@endsection
