@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <h4>Cập nhật Nghề nghiệp</h4>
  <form method="POST" action="{{ route('employments.update', ['employment' => $employment->id]) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset class="fieldset">
      <legend>Nghề nghiệp</legend>
      <label>Chức danh
        <input id="position" name="position" type="text" value="{{ old('position', $employment->position) }}" autofocus>
      </label>
      @if ($errors->has('position'))
        <p class="help-text">{{ $errors->first('position') }}</p>
      @endif

      <label>Tên công ty <i class="fi-asterisk"></i>
        <input id="company" name="company" type="text" value="{{ old('company', $employment->company) }}" required>
      </label>
      @if ($errors->has('company'))
        <p class="help-text">{{ $errors->first('company') }}</p>
      @endif

      <label for="description">Mô tả</label>
      <textarea name="description" id="description" rows="5">
        {{ old('description', $employment->description) }}
      </textarea>
      @if ($errors->has('description'))
        <p class="help-text">{{ $errors->first('description') }}</p>
      @endif

      <div class="grid-x grid-padding-x">
        <div class="medium-4 cell">
          <label>Từ
            <input id="started_at" class="date-picker" name="started_at" type="text" value="{{ old('started_at', $employment->getStartedAt('Y-m-d', 'edit')) }}">
          </label>
          @if ($errors->has('started_at'))
            <p class="help-text">{{ $errors->first('started_at') }}</p>
          @endif
        </div>
        <div class="medium-4 cell">
          <label>Đến
            <input id="ended_at" class="date-picker" name="ended_at" type="text" value="{{ old('ended_at', $employment->getEndedAt('Y-m-d', 'edit')) }}" {{ old('is_current') ? 'disabled' : '' }}>
          </label>
          @if ($errors->has('ended_at'))
            <p class="help-text">{{ $errors->first('ended_at') }}</p>
          @endif
        </div>
        <div class="medium-4 cell">
          <label>&nbsp;</label>
          <label for="is_current">
            <input id="is_current" name="is_current" class="disable-elm" data-target="#ended_at" type="checkbox" value="1" {{ old('is_current', $employment->is_current) ? 'checked' : '' }}>
            Công việc hiện tại
          </label>
        </div>
      </div>
    </fieldset>

    <button type="submit" class="button primary expanded">Cập nhật</button>
  </form>
</div>
@endsection
