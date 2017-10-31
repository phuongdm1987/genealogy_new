<!-- Employment post -->
<div class="feature-box padding-bottom-1">
  <h4 class="separator-left">
    Học vấn
    <a href="{{ route('educations.create', ['current_id' => $user->id]) }}"><i class="fi-plus"></i></a>
  </h4>

  @forelse($user->educations->sortByDesc('created_at') as $education)
    <div class="box margin-bottom-1">
      <h5 class="subheader">
        {{ $education->school }}
        <form class="float-right" action="{{ route('educations.destroy', ['education' => $education->id]) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="button small secondary">Xóa <i class="fi-x"></i></button>
        </form>
        <a class="float-right button small primary" href="{{ route('educations.edit', ['education' => $education->id]) }}">Cập nhật <i class="fi-pencil"></i></a>
      </h5>
      <div class="grid-x">
        <div class="cell small-2">
          Chuyên ngành <br>
          Bằng cấp <br>
          Thời gian
        </div>
        <div class="cell small-10">
          {{ $education->getSubject() }} <br>
          {{ $education->getDegree() }} <br>
          {{ $education->getStartedAt('d-m-Y') }} - {{ $education->getEndedAt('d-m-Y') }}
        </div>
      </div>

      <div class="margin-top-1">
        @if($education->description)
          {{ $education->description }}
        @else
          <i>Mô tả toàn bộ quá trình học vấn của bạn, cũng như các bằng cấp bạn đã được và các khóa huấn luyện bạn đã tham gia</i>
        @endif
      </div>

    </div>
  @empty
    <div class="box margin-bottom-1">
      <h5 class="subheader text-center">Thông tin chưa được cập nhật</h5>
    </div>
  @endforelse
</div>
<!-- End Employment post -->
