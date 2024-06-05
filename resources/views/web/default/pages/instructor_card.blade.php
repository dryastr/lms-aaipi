@php
    $canReserve = false;
    if(!empty($instructor->meeting) and !$instructor->meeting->disabled and !empty($instructor->meeting->meetingTimes) and $instructor->meeting->meeting_times_count > 0) {
        $canReserve = true;
    }
@endphp

<div class="mt-25 p-20 course-teacher-card instructors-list text-center d-flex align-items-center flex-column position-relative">

    <a href="{{ $instructor->getProfileUrl() }}{{ ($canReserve) ? '?tab=appointments' : '' }}" class="text-center d-flex flex-column align-items-center justify-content-center">
        <div class=" teacher-avatar mt-5 position-relative">
            <img src="{{ $instructor->getAvatar(190) }}" class="lazyload img-cover" alt="{{ $instructor->full_name }}">
        </div>

        <h3 class="mt-20 font-16 font-weight-bold text-dark-blue text-center">{{ $instructor->full_name }}</h3>
    </a>

    <div class="font-weight-500 mt-5 font-14 text-instructor">
        @if(!empty($instructor->bio))
            {{ $instructor->bio }}
        @endif
    </div>

        <div class="stars-card d-flex align-items-center mt-10">
        @include('web.default.includes.webinar.rate',['rate' => $instructor->rates()])
    </div>
</div>
