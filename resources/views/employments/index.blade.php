<!-- Employment post -->
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
          {{ $employment->getStartedAt('d-m-Y') }} - {{ $employment->getEndedAt('d-m-Y') }}
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
</div>
<!-- End Employment post -->
