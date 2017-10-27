@foreach (['alert', 'warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))
    <div class="callout {{ $msg }} small" data-closable="slide-out-right">
      <h5>{{ Session::get('alert-' . $msg) }}</h5>
      <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
@endforeach

@if ($errors->any())
  <div class="callout alert small" data-closable="slide-out-right">
    <h5>Có lỗi xảy ra vui lòng thử lại!</h5>
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
