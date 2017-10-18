@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-4 medium-offset-4">
    <fieldset class="fieldset">
      <legend>Xác minh tài khoản</legend>
      Email của bạn đã được xác minh thành công. Bấm vào đây để <a href="{{ route('login') }}">đăng nhập</a>
    </fieldset>
</div>
@endsection
