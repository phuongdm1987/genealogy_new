@extends('layout', ['sidebar' => true])

@section('content')
<!-- Feature post -->
<div class="media-object">
  <div class="media-object-section">
    <div class="thumbnail relative">
      <img src= "{{ $user->getAvatar() }}" alt="{{ $user->name }}">
      @if($user->isDead())
        <i class="fi-bookmark size-72 av-dead"></i>
      @endif
    </div>
  </div>
  <div class="media-object-section main-section">
    <h3>
      {{ $user->name }}
      <i class="{{ $user->getSexIcon() }}"></i>
      <a href="{{ route('users.edit', ['user' => $user->hashid]) }}"><i class="fi-pencil"></i></a>
    </h3>
    <p><i class="fi-telephone"></i> {{ $user->getPhone() }}</p>
    <p><i class="fi-mail"></i> {{ $user->getEmail() }}</p>
    <p><i class="fi-foot"></i> {{ $user->getDob('d-m-Y') }} | <i class="fi-skull"></i> {{ $user->getDod() }}</p>
  </div>
</div>

<div class="feature-box padding-bottom-1">
  <h4 class="separator-left">
    Nghề nghiệp
    <a href="{{ route('employments.create', ['current_id' => $user->id]) }}"><i class="fi-plus"></i></a>
  </h4>

  @forelse($user->employments->sortByDesc('created_at') as $employment)
    <div class="box margin-bottom-1">
      <h5 class="subheader">
        {{ $employment->company }}
        <form class="float-right" action="{{ route('employments.destroy', ['employment' => $employment->id]) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="button small secondary">Xóa <i class="fi-x"></i></button>
        </form>
        <a class="float-right button small primary" href="{{ route('employments.edit', ['employment' => $employment->id]) }}">Cập nhật <i class="fi-pencil"></i></a>
      </h5>
      <div class="grid-x">
        <div class="cell small-2">
          Chức danh <br>
          Thời gian
        </div>
        <div class="cell small-10">
          {{ $employment->getPosition() }} <br>
          {{ $employment->getStartedAt() }} - {{ $employment->getEndedAt() }}
        </div>
      </div>

      <div class="margin-top-1">
        @if($employment->description)
          {{ $employment->description }}
        @else
          <i>Mô tả ngắn về vai trò, nhiệm vụ và những thành tựu đạt được</i>
        @endif
      </div>

    </div>
  @empty
    <div class="box margin-bottom-1">
      <h5 class="subheader text-center">Thông tin chưa được cập nhật</h5>
    </div>
  @endforelse

<!-- End Feature post -->

<!-- Relation post -->
<ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge="500" data-tabs id="deeplinked-tabs">
  <li class="tabs-title is-active"><a href="#parents">Bố / Mẹ</a></li>
  <li class="tabs-title"><a href="#siblings">Anh / Chị / Em</a></li>
  <li class="tabs-title"><a href="#couple" aria-selected="true">Vợ / Chồng</a></li>
  <li class="tabs-title"><a href="#children">Con cái</a></li>
</ul>

<div class="tabs-content" data-tabs-content="deeplinked-tabs">
  <!-- Parent tab content -->
  <div class="tabs-panel is-active" id="parents">
    <div class="grid-x grid-margin-x">
      <!-- Parent item -->
      @if($user->getParents())
        @foreach($user->getParents() as $parent)
          <div class="cell medium-3">
            <div class="card">
              <div class="card-divider">
                <a href="{{ route('users.show', ['user' => $parent->hashid]) }}">
                  {{ $parent->name }} <i class="{{ $parent->getSexIcon() }}"></i>
                </a>
              </div>
              <div class="thumbnail relative">
                <a href="{{ route('users.show', ['user' => $parent->hashid]) }}">
                  <img src="{{ $parent->getAvatar() }}" alt="{{ $parent->name }}">
                </a>
                @if($parent->isDead())
                  <i class="fi-bookmark size-72 av-dead"></i>
                @endif
              </div>
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

  <!-- Sibling tab content -->
  <div class="tabs-panel" id="siblings">
    <div class="grid-x grid-margin-x">
      <!-- Sibling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            Anh / Chị / Em
          </div>
          <div class="card-section">
            <p><a href="{{ route('siblings.create', ['parent_id' => $user->parent_id]) }}"><i class="fi-plus"></i> Thêm mới</a></p>
            <p><a href="{{ route('siblings.index') }}"><i class="fi-list-bullet"></i> Xem tất cả</a></p>
          </div>
        </div>
      </div>
      <!-- End Sibling item -->

      <!-- Sibling item -->
      @foreach($user->getSiblingsWithoutCouple() as $sibling)
        <div class="cell medium-3">
          <div class="card">
            <div class="card-divider">
              <a href="{{ route('users.show', ['user' => $sibling->hashid]) }}">
                {{ $sibling->name }} <i class="{{ $sibling->getSexIcon() }}"></i>
              </a>
            </div>
            <div class="thumbnail relative">
              <a href="{{ route('users.show', ['user' => $sibling->hashid]) }}">
                <img src="{{ $sibling->getAvatar() }}" alt="{{ $sibling->name }}">
              </a>
              @if($sibling->isDead())
                <i class="fi-bookmark size-72 av-dead"></i>
              @endif
            </div>
            <div class="card-section">
              <p><i class="fi-telephone"></i> {{ $sibling->getPhone() }}</p>
              <p><i class="fi-mail"></i> {{ $sibling->getEmail() }}</p>
              <p>
                <i class="fi-foot"></i> {{ $sibling->getDob() }} | <i class="fi-skull"></i> {{ $sibling->getDod() }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
      <!-- End Sibling item -->
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
            <p><a href="{{ route('marriages.create', ['current_id' => $user->id]) }}"><i class="fi-plus"></i> Thêm mới</a></p>
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
              <a href="{{ route('users.show', ['user' => $wife->hashid]) }}">
                {{ $wife->name }} <i class="{{ $wife->getSexIcon() }}"></i>
              </a>
            </div>
            <div class="thumbnail relative">
              <a href="{{ route('users.show', ['user' => $wife->hashid]) }}">
                <img src="{{ $wife->getAvatar() }}" alt="{{ $wife->name }}">
              </a>
              @if($wife->isDead())
                <i class="fi-bookmark size-72 av-dead"></i>
              @endif
            </div>
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
            <p><a href="{{ route('children.create', ['parent_id' => $user->id]) }}"><i class="fi-plus"></i> Thêm mới</a></p>
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
                <a href="{{ route('users.show', ['user' => $child->hashid]) }}">
                  {{ $child->name }} <i class="{{ $child->getSexIcon() }}"></i>
                </a>
              </div>
              <div class="thumbnail relative">
                <a href="{{ route('users.show', ['user' => $child->hashid]) }}">
                  <img src="{{ $child->getAvatar() }}" alt="{{ $child->name }}">
                </a>
                @if($child->isDead())
                  <i class="fi-bookmark size-72 av-dead"></i>
                @endif
              </div>
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
