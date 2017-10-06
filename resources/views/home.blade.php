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
<ul class="tabs" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge="500" data-tabs id="collapsing-tabs">
  <li class="tabs-title is-active">
    <a href="#wife" aria-selected="true">{{ $user->isMan() ? 'Wifes' : 'Husbands' }}</a>
  </li>
  <li class="tabs-title"><a href="#panel2c">Sbling</a></li>
  <li class="tabs-title"><a href="#panel3c">Children</a></li>
</ul>

<div class="tabs-content" data-tabs-content="collapsing-tabs">
  <!-- Wife tab content -->
  <div class="tabs-panel is-active" id="wife">
    <div class="grid-x grid-margin-x">
      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <a href="{{ route('marriages.create') }}" class="button"><i class="fi-plus"></i></a>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->
    </div>
  </div>
  <!-- End Wife tab content -->

  <!-- Children tab content -->
  <div class="tabs-panel" id="panel2c">
    <div class="grid-x grid-margin-x">
      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->
    </div>
  </div>
  <!-- End Children tab content -->

  <!-- Sbling tab content -->
  <div class="tabs-panel" id="panel3c">
    <div class="grid-x grid-margin-x">
      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->

      <!-- Sbling item -->
      <div class="cell medium-3">
        <div class="card">
          <div class="card-divider">
            This is a header
          </div>
          <img src="http://via.placeholder.com/150x150">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <!-- End Sbling item -->
    </div>
  </div>
  <!-- End Sbling tab content -->


</div>
<!-- End Relation post -->
@endsection
