@extends('layout', ['sidebar' => false])

@section('content')
<div class="cell medium-8 medium-offset-2">
  <h4>Cập nhật Học vấn</h4>
  <form method="POST" action="{{ route('educations.update', ['education' => $education->id]) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <fieldset class="fieldset">
      <legend>Học vấn</legend>
      <label>Chuyên ngành
        <input id="subject" name="subject" type="text" value="{{ old('subject', $education->subject) }}" autofocus>
      </label>
      @if ($errors->has('subject'))
        <p class="help-text">{{ $errors->first('subject') }}</p>
      @endif

      <label>Trường <i class="fi-asterisk"></i>
        <input id="school" name="school" type="text" value="{{ old('school', $education->school) }}" required>
      </label>
      @if ($errors->has('school'))
        <p class="help-text">{{ $errors->first('school') }}</p>
      @endif

      <label>Bằng cấp
        <input id="degree" name="degree" type="text" value="{{ old('degree', $education->degree) }}">
      </label>
      @if ($errors->has('degree'))
        <p class="help-text">{{ $errors->first('degree') }}</p>
      @endif

      <label for="description">Thành tựu</label>
      <textarea name="description" id="description" rows="5">
        {{ old('description', $education->description) }}
      </textarea>
      @if ($errors->has('description'))
        <p class="help-text">{{ $errors->first('description') }}</p>
      @endif

      <div class="grid-x grid-padding-x">
        <div class="medium-6 cell">
          <label>Từ
            <input id="started_at" class="date-picker" name="started_at" type="text" value="{{ old('started_at', $education->getStartedAt('Y-m-d', 'edit')) }}">
          </label>
          @if ($errors->has('started_at'))
            <p class="help-text">{{ $errors->first('started_at') }}</p>
          @endif
        </div>
        <div class="medium-6 cell">
          <label>Đến
            <input id="ended_at" class="date-picker" name="ended_at" type="text" value="{{ old('ended_at', $education->getEndedAt('Y-m-d', 'edit')) }}">
          </label>
          @if ($errors->has('ended_at'))
            <p class="help-text">{{ $errors->first('ended_at') }}</p>
          @endif
        </div>
      </div>
    </fieldset>

    <button type="submit" class="button primary expanded">Cập nhật</button>
  </form>
</div>
@endsection
