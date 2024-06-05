
<link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">

<div id="course-teacher-custom" class="rounded-lg course-teacher-card d-block d-sm-flex content_first p-20 m-0">

    @if(!empty($webinarPartnerTeacher))
        <span class="user-select-none px-15 py-10 bg-gray200 off-label text-gray text-white font-12 rounded-sm ml-auto">{{ trans('public.invited') }}</span>
    @endif

    <div class="mt-20">
        <img src="{{ $courseTeacher->getAvatar(100) }}" class="img_sidebar_profile mx-auto d-block" alt="{{ $courseTeacher->full_name }}">

        @if($courseTeacher->offline)
            <span class="user-circle-badge unavailable d-flex align-items-center justify-content-center">
              <i data-feather="slash" width="20" height="20" class="text-white"></i>
           </span>
        @elseif($courseTeacher->verified)
            <span class="user-circle-badge has-verified d-flex align-items-center justify-content-center">
                <i data-feather="check" width="20" height="20" class="text-white"></i>
            </span>
        @endif
    </div>
    <div class="d-flex flex-column ml-20 ml-lg-40">
        <h3 class="mt-10 font-16 font-weight-bold text-secondary">{{ $courseTeacher->full_name }}</h3>
        <span class="mt-5 font-14 font-weight-500 text-gray">{{ $courseTeacher->bio }}</span>
        <div class="d-flex flex-column followers-status mt-15">
            <span class="font-14 text-gray text-image">{!! nl2br($courseTeacher->about) !!}</span>
        </div>
        </p>
    </div>
    @php
        $hasMeeting = !empty($courseTeacher->hasMeeting());
    @endphp
</div>
