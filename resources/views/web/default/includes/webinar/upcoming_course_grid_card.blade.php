<div class="webinar-card webinar-card-box">
    <figure>
        <div class="image-box">
            {{-- <span class="badge badge-upcoming badge-secondary rounded-pill">
                <img src="{{ asset('assets/admin/img/home/upcoming-course/archive-add.svg') }}" class="" alt="">    
            </span> --}}

            <a href="{{ $upcomingCourse->getUrl() }}">
                {{-- <img src="{{ $upcomingCourse->getImage() }}" class="lazyload img-cover" alt="{{ $upcomingCourse->title }}"> --}}
                <img src="{{ $upcomingCourse->getImage() }}" onerror="this.onerror=null;this.src='{{createImageTitle($upcomingCourse->title)}}';" class="lazyload img-cover" alt="{{ $upcomingCourse->title }}" style="background-color: white">
            </a>
            <div class="badge-date">
                @if(!empty($upcomingCourse->publish_date))
                    <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Tanggal Publish">
                        <div class="group-badge-date d-flex justify-content-center align-items-center">
                            <div class="calender-icon">
                                <i data-feather="calendar" width="12" height="12" class="webinar-icon text-white"></i>
                            </div>
                            <span class="date-published ml-5 font-12 text-white">
                                {{-- {{ dateTimeFormat($upcomingCourse->publish_date, 'j M Y') }} --}}
                                {{ \Carbon\Carbon::parse($upcomingCourse->publish_date)->locale('id')->translatedFormat('j F Y | H:i') }}
                            </span>
                        </div>
                    </div>
                    
                @endif
            </div>
        </div>

        <figcaption class="webinar-card-body">
            <div class="d-flex justify-content-between">
                <div class="text-center badge badge-primary rounded-pill" style="cursor: pointer; pointer-events: auto">
                    @if(!empty($upcomingCourse->category))
                        <a href="{{ $upcomingCourse->category->getUrl() }}" target="_blank" class="text-decoration-none text-white badge-tooltip" data-toggle="tooltip" data-placement="top" title="{{ $upcomingCourse->category->title }}" style="cursor: pointer">
                            <span class="d-block font-14 text-white py-5 px-10">
                                {{ Str::limit($upcomingCourse->category->title, 15) }}
                            </span>
                        </a>
                    @endif
                </div>
                @if(!empty($upcomingCourse->duration))
                    <div class="d-flex align-items-center">
                        <i data-feather="clock" width="20" height="20" class="webinar-icon text-white"></i>
                        <span class="duration font-14 ml-5 text-white">{{ convertMinutesToHourAndMinute($upcomingCourse->duration) }} {{ trans('home.hours') }}</span>
                    </div>
                @endif
            </div>

            <a href="{{ $upcomingCourse->getUrl() }}">
                {{-- <h3 class="mt-15 webinar-title font-weight-bold font-16 text-dark-blue">{{ clean($upcomingCourse->title,'title') }}</h3> --}}
                <h3 class="mt-15 webinar-title font-weight-bold font-16 text-white">{{ $upcomingCourse->title,'title' }}</h3>
            </a>

            <div class="d-flex justify-content-between mt-15">
                <div class="user-inline-avatar d-flex align-items-center">
                    <div class="avatar avatar-size bg-gray200">
                        <img src="{{ $upcomingCourse->teacher->getAvatar() }}" class="img-cover" alt="{{ $upcomingCourse->teacher->full_name }}">
                    </div>
                    <a href="{{ $upcomingCourse->teacher->getProfileUrl() }}" target="_blank" class="user-name ml-5 font-14 text-white">{{ $upcomingCourse->teacher->full_name }}</a>
                </div>
                <div class="webinar-price-box">
                    @if(!empty($upcomingCourse->price) and $upcomingCourse->price > 0)
                        <span class="real text-white">{{ handlePrice($upcomingCourse->price) }}</span>
                    @else
                        <span class="real font-14 text-white">{{ trans('public.free') }}</span>
                    @endif
                </div>
            </div>
        </figcaption>
    </figure>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    $(document).ready(function(){
        $('.badge-tooltip').tooltip();
    });
</script>
