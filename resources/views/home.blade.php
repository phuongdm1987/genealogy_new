@extends('layout', ['sidebar' => true])

@section('content')
<!-- Feature post -->
<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail">
      <img src= "{{ $user->getAvatar() }}" alt="{{ $user->name }}">
    </div>
  </div>
  <div class="media-object-section main-section">
    <h4>{{ $user->name }} <i class="{{ $user->getSexIcon() }}"></i></h4>
    <p><i class="fi-telephone"></i> {{ $user->getPhone() }}</p>
    <p><i class="fi-mail"></i> {{ $user->getEmail() }}</p>
    <p><i class="fi-foot"></i> {{ $user->getDob() }} | <i class="fi-skull"></i> {{ $user->getDod() }}</p>
  </div>
</div>
<!-- End Feature post -->

<!-- Relation post -->
<ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge="500" data-tabs id="deeplinked-tabs">
  <li class="tabs-title is-active"><a href="#parents">Bố / Mẹ</a></li>
  <li class="tabs-title"><a href="#sblings">Anh / Chị / Em</a></li>
  <li class="tabs-title"><a href="#couple" aria-selected="true">Vợ / Chồng</a></li>
  <li class="tabs-title"><a href="#children">Con cái</a></li>
</ul>

<div class="tabs-content" data-tabs-content="deeplinked-tabs">
  <!-- Parent tab content -->
  <div class="tabs-panel is-active" id="parents">
    <div class="grid-x grid-margin-x">
      <!-- Parent item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            Bố / Mẹ
          </div>
          <div class="card-section">
            <p><a href="{{ route('parents.create') }}"><i class="fi-plus"></i> Thêm mới</a></p>
            <p><a href="{{ route('parents.index') }}"><i class="fi-list-bullet"></i> Xem tất cả</a></p>
          </div>
        </div>
      </div>
      <!-- End Parent item -->

      <!-- Parent item -->
      @if($user->getParents())
        @foreach($user->getParents() as $parent)
          <div class="cell medium-3">
            <div class="card">
              <div class="card-divider">
                <a href="#">{{ $parent->name }}</a>
              </div>
              <img src="{{ $parent->getAvatar() }}" alt="{{ $parent->name }}">
              <div class="card-section">
                <p><i class="fi-telephone"></i> {{ $parent->getPhone() }}</p>
                <p><i class="fi-mail"></i> {{ $parent->getEmail() }}</p>
                <p>
                  <i class="fi-foot"></i> {{ $parent->getDob() }} | <i class="fi-skull"></i> {{ $parent->getDod() }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      @endif
      <!-- End Parent item -->
    </div>
  </div>
  <!-- End Parent tab content -->

  <!-- Sbling tab content -->
  <div class="tabs-panel" id="sblings">
    <div class="grid-x grid-margin-x">
      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            Anh / Chị / Em
          </div>
          <div class="card-section">
            <p><a href="{{ route('sblings.create') }}"><i class="fi-plus"></i> Thêm mới</a></p>
            <p><a href="{{ route('sblings.index') }}"><i class="fi-list-bullet"></i> Xem tất cả</a></p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      @foreach($user->getSiblings() as $sbling)
        <div class="cell medium-3">
          <div class="card">
            <div class="card-divider">
              <a href="#">{{ $sbling->name }}</a>
            </div>
            <img src="{{ $sbling->getAvatar() }}" alt="{{ $sbling->name }}">
            <div class="card-section">
              <p><i class="fi-telephone"></i> {{ $sbling->getPhone() }}</p>
              <p><i class="fi-mail"></i> {{ $sbling->getEmail() }}</p>
              <p>
                <i class="fi-foot"></i> {{ $sbling->getDob() }} | <i class="fi-skull"></i> {{ $sbling->getDod() }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
      <!-- End Sbling item -->
    </div>
  </div>
  <!-- End Children tab content -->

  <!-- Wife tab content -->
  <div class="tabs-panel" id="couple">
    <div class="grid-x grid-margin-x">
      <!-- Wife item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            Vợ / Chồng
          </div>
          <div class="card-section">
            <p><a href="{{ route('marriages.create') }}"><i class="fi-plus"></i> Thêm mới</a></p>
            <p><a href="{{ route('marriages.index') }}"><i class="fi-list-bullet"></i> Xem tất cả</a></p>
          </div>
        </div>
      </div>
      <!-- End Wife item -->

      <!-- Wife item -->
      @foreach($user->couple as $wife)
        <div class="cell medium-3">
          <div class="card">
            <div class="card-divider">
              <a href="#">{{ $wife->name }}</a>
            </div>
            <img src="{{ $wife->getAvatar() }}" alt="{{ $wife->name }}">
            <div class="card-section">
              <p><i class="fi-telephone"></i> {{ $wife->getPhone() }}</p>
              <p><i class="fi-mail"></i> {{ $wife->getEmail() }}</p>
              <p>
                <i class="fi-foot"></i> {{ $wife->getDob() }} | <i class="fi-skull"></i> {{ $wife->getDod() }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
      <!-- End Wife item -->
    </div>
  </div>
  <!-- End Wife tab content -->

  <!-- Children tab content -->
  <div class="tabs-panel" id="children">
    <div class="grid-x grid-margin-x">
      <!-- Children item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            Con cái
          </div>
          <div class="card-section">
            <p><a href="{{ route('children.create') }}"><i class="fi-plus"></i> Thêm mới</a></p>
            <p><a href="{{ route('children.index') }}"><i class="fi-list-bullet"></i> Xem tất cả</a></p>
          </div>
        </div>
      </div>
      <!-- End Children item -->

      <!-- Children item -->
      @if($user->children)
        @foreach($user->getChildren() as $child)
          <div class="cell medium-3">
            <div class="card">
              <div class="card-divider">
                <a href="#">{{ $child->name }}</a>
              </div>
              <img src="{{ $child->getAvatar() }}" alt="{{ $child->name }}">
              <div class="card-section">
                <p><i class="fi-telephone"></i> {{ $child->getPhone() }}</p>
                <p><i class="fi-mail"></i> {{ $child->getEmail() }}</p>
                <p>
                  <i class="fi-foot"></i> {{ $child->getDob() }} | <i class="fi-skull"></i> {{ $child->getDod() }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      @endif
      <!-- End Children item -->
    </div>
  </div>
  <!-- End Children tab content -->


</div>
<!-- End Relation post -->
@endsection
