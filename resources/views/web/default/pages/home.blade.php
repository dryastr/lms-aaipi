@extends(getTemplate().'.layouts.app')

@push('styles_top')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.2.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="/assets/default/vendors/owl-carousel2/owl.carousel.min.css">
<link rel="stylesheet" href="/assets/aaipi/css/web/default/home.css">
@endpush

@section('content')

@if(!empty($heroSectionData))

@if(!empty($heroSectionData['has_lottie']) and $heroSectionData['has_lottie'] == "1")
@push('scripts_bottom')
<script src="/assets/default/vendors/lottie/lottie-player.js"></script>
@endpush
@endif

<section class="slider-container {{ ($heroSection == "2") ? 'slider-hero-section2' : '' }}" @if(empty($heroSectionData['is_video_background'])) style="background-image: url('{{ $heroSectionData['hero_background'] }}')" @endif>
    {{-- @if($heroSection == "1")
    @if(!empty($heroSectionData['is_video_background']))
    <video playsinline autoplay muted loop id="homeHeroVideoBackground" class="img-cover">
        <source src="{{ $heroSectionData['hero_background'] }}" type="video/mp4">
    </video>
    @endif

    <div class="mask"></div>
    @endif --}}

    <div class="container user-select-none">

        @if($heroSection == "2")
        <div class="row slider-content align-items-center hero-section2 flex-column-reverse flex-md-row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="text-center postion-text-title-group">
                    <h1 class="text-black font-weight-bold">{{ $heroSectionData['title'] }}</h1>
                    <p class="text-black slide-hint mt-20 postion-text-description">{!! nl2br($heroSectionData['description']) !!}</p>
                </div>

                <div class="d-flex justify-content-center">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="btn btn-primary rounded-pill mt-50">
                                {{ trans('home.admin_panel') }}
                            </a>
                        @else
                            <a href="/panel" class="btn btn-primary rounded-pill mt-50">
                                {{ trans('home.dashboard_panel') }}
                            </a>
                        @endif
                    @else
                    <a href="/login" class="btn btn-primary rounded-pill mt-50">
                        {{ trans('home.start_now') }}
                    </a>
                    @endauth
                </div>
            </div>
            {{-- <div class="col-12 col-md-5 col-lg-6">
                            @if(!empty($heroSectionData['has_lottie']) and $heroSectionData['has_lottie'] == "1")
                                <lottie-player src="{{ $heroSectionData['hero_vector'] }}" background="transparent" speed="1" class="w-100" loop autoplay></lottie-player>
            @else
            <img src="{{ $heroSectionData['hero_vector'] }}" alt="{{ $heroSectionData['title'] }}" class="img-cover">
            @endif
        </div> --}}
    </div>
    @else
    <div class="text-center slider-content">
        <h1>{{ $heroSectionData['title'] }}</h1>
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-12 col-md-9 col-lg-7">
                <p class="mt-30 slide-hint">{!! nl2br($heroSectionData['description']) !!}</p>

                <form action="/search" method="get" class="d-inline-flex mt-30 mt-lg-50 w-100">
                    <div class="form-group d-flex align-items-center m-0 slider-search p-10 bg-white w-100">
                        <input type="text" name="search" class="form-control border-0 mr-lg-50" placeholder="{{ trans('home.slider_search_placeholder') }}" />
                        <button type="submit" class="btn btn-primary rounded-pill">{{ trans('home.find') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    </div>
</section>
@endif

{{-- Statistics --}}
{{-- @include('web.default.pages.includes.home_statistics') --}}

{{-- Categories Section | GUNAKAN DATA SECARA DINAMIS! (BELUM SELESAI) --}}
<section class="home-sections home-sections-swiper index-level-sections">
    <div class="d-flex justify-content-center">
        <div class="card-groups">
            <div class="d-flex justify-content-center responsive-image">
                <div class="col-sm-4 col-md-4 pad-col">
                    <div class="card-body-hero-left">
                        <img src="{{ asset('assets/admin/img/home/hero-card-1.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 pad-col">
                    <div class="card-body-hero-center">
                        <img src="{{ asset('assets/admin/img/home/hero-card-2.jpeg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 pad-col">
                    <div class="card-body-hero-right">
                        <img src="{{ asset('assets/admin/img/home/hero-card-3.jpeg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="categories-groups container p-0">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="col-md-4 p-0">
                <h1 class="mb-15">{{ trans('home.explore_title') }}</h1>
                <p>{{ trans('home.explore_desc') }}</p>
                <div class="d-flex">
                    <a class="btn btn-primary rounded-pill mt-30" href="/login">{{ trans('home.explore_all') }}</a>
                </div>
            </div>
            <div class="col-md-8 p-0">
                <div class="card-groups-categories">
                    <div class="d-flex justify-content-start flex-wrap position-top-categories">
                        @foreach($trendCategories as $trend)
                        <div class="d-flex flex-fill h-card-categories">
                            <a href="{{ $trend->category->getUrl() }}" class="d-flex justify-content-center align-items-center text-center flex-column box-sizing-card-categories flex-fill">
                                <div class="d-flex justify-content-center align-items-center text-center card-body-category flex-nowrap" style="background-color: {{ $trend->color }}">
                                    <div class="d-flex justify-content-center align-items-center img-categories">
                                        <img src="{{ $trend->getIcon() }}" width="10" class="img-cover" alt="{{ $trend->category->title }}">
                                    </div>
                                </div>
                                <span class="mt-10">{{ $trend->category->slug }}</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@include('web.default.pages.includes.home_statistics')

{{-- Rating Section | GUNAKAN DATA SECARA DINAMIS! --}}
<!-- <section class="d-flex home-sections home-sections-swiper justify-content-center align-items-center text-center rating-section" id="bg-rating-section">
    <div class="rating-groups">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center text-center flex-wrap">
                    <div class="rating-item flex-column text-center">
                        <div class="rating-icon mb-20">
                            <img src="{{ asset('assets/admin/img/home/rating/courses-laptop.svg') }}" alt="">
                        </div>
                        <div class="rating-total text-white">
                            <h1 class="mb-5">10K</h1>
                            <p>{{ trans('home.learning_online') }}</p>
                        </div>
                    </div>
                    <div class="line-space-rating"></div>
                    <div class="rating-item flex-column text-center">
                        <div class="rating-icon mb-20">
                            <img src="{{ asset('assets/admin/img/home/rating/cont-certificate.svg') }}" alt="">
                        </div>
                        <div class="rating-total text-white">
                            <h1 class="mb-5">10K</h1>
                            <p>{{ trans('home.cont_certif') }}</p>
                        </div>
                    </div>
                    <div class="line-space-rating"></div>
                    <div class="rating-item flex-column text-center">
                        <div class="rating-icon mb-20">
                            <img src="{{ asset('assets/admin/img/home/rating/books-lamp.svg') }}" alt="">
                        </div>
                        <div class="rating-total text-white">
                            <h1 class="mb-5">10K</h1>
                            <p>{{ trans('home.learning_user') }}</p>
                        </div>
                    </div>
                    <div class="line-space-rating"></div>
                    <div class="rating-item flex-column text-center">
                        <div class="rating-icon mb-20">
                            <img src="{{ asset('assets/admin/img/home/rating/top-succes.svg') }}" alt="">
                        </div>
                        <div class="rating-total text-white">
                            <h1 class="mb-5">10K</h1>
                            <p>{{ trans('home.succes_level') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

{{-- Vision Section | GUNAKAN DATA SECARA DINAMIS! (BELUM SELESAI)  --}}
<section class="home-sections home-sections-swiper container vision-section position-relative">
    <div class="row align-items-center">
        <div class="col-12 col-lg-6 col-md-6 col-sm-6">
            <div class="position-relative vision-section-hero-card">
                <div class="">
                    <img src="{{ asset('assets/admin/img/home/hero-card-3.jpeg') }}" class="lazyload vision-hero-img" alt="{{ $rewardProgramSection['title'] }}">
                </div>
                <div class="example-vision-card bg-white rounded-sm shadow-lg p-5 p-md-15 d-flex align-items-center">
                    <div class="container home-video-vision d-flex flex-column align-items-center justify-content-center position-relative" style="background-image: url('{{ $boxVideoOrImage['background'] ?? '' }}')">
                        <a href="#" class="vision-video-play-button d-flex align-items-center justify-content-center position-relative">
                            <img src="{{ asset('assets/admin/img/home/visions/play-button.svg') }}" class="lazyload" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-20 mt-lg-0">
            <div class="">
                <h2 class="font-36 font-weight-bold text-dark">Kami Memaksimalkan Anda Pertumbuhan Pembelajaran</h2>
                <p class="font-16 font-weight-normal text-gray my-15">{{ $rewardProgramSection['description'] ?? '' }}</p>
                <div class="d-flex flex-wrap">
                    <div class="col-12 col-md-6 p-0">
                        <div class="vision-item-icon d-flex flex-fill">
                            <img src="{{ asset('assets/admin/img/home/visions/badge-check.svg') }}" alt="">
                            <div class="ml-10">
                                <p>{{ trans('home.course_services') }}</p>
                            </div>
                        </div>
                        <div class="vision-item-icon d-flex flex-fill">
                            <img src="{{ asset('assets/admin/img/home/visions/badge-check.svg') }}" alt="">
                            <div class="ml-10">
                                <p>{{ trans('home.big_services') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-0">
                        <div class="vision-item-icon d-flex flex-fill">
                            <img src="{{ asset('assets/admin/img/home/visions/badge-check.svg') }}" alt="">
                            <div class="ml-10">
                                <p>{{ trans('home.professional_teacher') }}</p>
                            </div>
                        </div>
                        <div class="vision-item-icon d-flex flex-fill">
                            <img src="{{ asset('assets/admin/img/home/visions/badge-check.svg') }}" alt="">
                            <div class="ml-10">
                                <p>{{ trans('home.lifetime') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-15 d-flex align-items-center">
                    <a href="/classes" class="btn btn-primary mr-15 rounded-pill">{{ trans('home.explore_more') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach($homeSections as $homeSection)

{{-- Testimonials --}}
@if($homeSection->name == \App\Models\HomeSection::$testimonials)
<section class="home-sections">
    <div class="position-testimonials">
        <div class="d-flex justify-content-center align-items-center text-center">
            <div>
                <p class="text-white fw-lighter">Apa kata mereka tentang e-LMS?</p>
            </div>
        </div>

        <div class="position-relative mt-20 ltr">
            <div class="customers-testimonials">

                <div class="swiper-container testimonials-swiper-container px-12 swiper-position-testimonial">
                    <div class="swiper-wrapper py-20">
                        @if (!empty($testimonials) && !$testimonials->isEmpty())
                        @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonials-card position-relative text-center w-100">
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <div class="caption-icon">
                                        <img src="{{ asset('assets/admin/img/home/testimonials/caption.svg') }}" class="my-30" alt="">
                                        <div class="d-flex justify-content-center align-items-center text-center">
                                            <p class="caption-comments text-white font-weight-400">{!! nl2br($testimonial->comment) !!}</p>
                                        </div>
                                    </div>
                                    <div class="w-100">
                                        <div class="groups-testimonials-title mt-20 mb-30">
                                            <h2 class="section-title text-white">{{ $testimonial->user_name }}</h2>
                                            <p class="section-hint text-white mt-5">{{ $testimonial->user_bio }}</p>
                                        </div>
                                        <div class="card-groups-testimonials mt-40">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="line-profile-testimonial">
                                                    <div class="card-item-testimonial m-0">
                                                        <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>Testimoni belum tersedia</p>
                        @endif
                    </div>
                </div>
                <div class="d-flex justify-content-center position-pagination-testimonials">
                    <div class="swiper-pagination testimonials-swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($homeSection->name == \App\Models\HomeSection::$latest_bundles and !empty($latestBundles) and !$latestBundles->isEmpty())
<section class="home-sections home-sections-swiper container">
    <div class="d-flex justify-content-between ">
        <div>
            <h2 class="section-title">{{ trans('update.latest_bundles') }}</h2>
            <p class="section-hint">{{ trans('update.latest_bundles_hint') }}</p>
        </div>

        <a href="/classes?type[]=bundle" class="btn btn-border-white">{{ trans('home.view_all') }}</a>
    </div>

    <div class="mt-10 position-relative">
        <div class="swiper-container latest-bundle-swiper px-12">
            <div class="swiper-wrapper py-20">
                @foreach($latestBundles as $latestBundle)
                <div class="swiper-slide">
                    @include('web.default.includes.webinar.grid-card',['webinar' => $latestBundle])
                </div>
                @endforeach

            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="swiper-pagination bundle-webinars-swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

{{-- Upcoming Course --}}
@if($homeSection->name == \App\Models\HomeSection::$upcoming_courses and !empty($upcomingCourses) and !$upcomingCourses->isEmpty())
<section class="home-sections home-sections-swiper container">
    <div class="d-flex justify-content-center flex-column">
        <div class="text-center">
            <h2 class="section-title text-black">{{ trans('update.upcoming_courses') }}</h2>
            <p class="section-hint mt-10 text-black">{{ trans('update.upcoming_courses_home_section_hint') }}</p>
        </div>

        <a href="/upcoming_courses?sort=newest" class="text-center text-black section-upcoming mt-5">{{ trans('home.view_all') }}</a>
    </div>

    <div class="mt-10 position-relative">
        <div class="swiper-container upcoming-courses-swiper px-12 swiper-position">
            <div class="swiper-wrapper py-20">
                @foreach($upcomingCourses as $upcomingCourse)
                <div class="swiper-slide">
                    @include('web.default.includes.webinar.upcoming_course_grid_card',['upcomingCourse' => $upcomingCourse])
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="swiper-pagination upcoming-courses-swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

{{-- Start Learning --}}
@if($homeSection->name == \App\Models\HomeSection::$video_or_image_section and !empty($boxVideoOrImage))
<section class="home-sections home-sections-swiper position-relative video-position">
    {{-- <div class="home-video-mask home-video-mask-position"></div> --}}
    <div class="pt-10 text-center">
        <h1 class="home-video-title mb-15 text-black">{{ $boxVideoOrImage['title'] ?? '' }}</h1>
        <div class="d-flex justify-content-center text-center mb-30">
            <p class="home-video-hint long-desc text-black">{{ $boxVideoOrImage['description'] ?? '' }}</p>
        </div>
    </div>
    <div class="container home-video-container d-flex flex-column align-items-center justify-content-center position-relative">
        <div class="d-flex justify-content-center align-items-center vid-position-responsive container">
            <img src="{{ $boxVideoOrImage['background'] ?? '' }}" alt="">
        </div>
        <div class="d-flex position-absolute">
            <a href="{{ $boxVideoOrImage['link'] ?? '' }}" class="home-video-play-button d-flex align-items-center justify-content-center position-relative">
                <img src="{{ asset('assets/admin/img/home/visions/play-button.svg') }}" class="size-play-button" alt="">
            </a>
        </div>
    </div>
</section>
@endif

{{-- Instructor for Dekstop --}}
@if($homeSection->name == \App\Models\HomeSection::$instructors and !empty($instructors) and !$instructors->isEmpty())
<section class="home-sections container instructor-dekstop">

    <div class="position-relative mt-20 ltr">
        <div class="row">
            <div class="col-md-6 mb-4" style="height:17rem">
                <div class="d-flex justify-content-center flex-column" style="width: 10rem;">
                    <div>
                        <h2 class="font-36 font-weight-bold text-dark mb-15">{{ trans('home.instructors') }}</h2>
                    </div>

                    <a href="/instructors" class="btn btn-primary btn-all-instructor rounded-pill w-80">{{ trans('home.all_instructors') }}</a>
                </div>
            </div>

            @foreach($instructors as $instructor)
            <div class="col-md-3 mb-4">
                <div class="shadow-effect shadow-h-effect">
                    <div class="instructors-card d-flex flex-column align-items-center justify-content-between h-100">
                        <div class="instructors-card-avatar custom-instructors-card-avatar">
                            <img src="{{ $instructor->getAvatar(108) }}" alt="{{ $instructor->full_name }}" class="lazyload rounded-circle img-cover">
                        </div>
                        <div class="instructors-card-info mt-10 text-center">
                            <a href="{{ $instructor->getProfileUrl() }}" target="_blank">
                                <h3 class="font-16 font-weight-bold text-dark-blue">{{ $instructor->full_name }}</h3>
                            </a>

                            <div class="stars-card d-flex align-items-center justify-content-center mt-10">
                                @php
                                $i = 5;
                                @endphp
                                @while(--$i >= 5 - $instructor->rates())
                                <i data-feather="star" width="20" height="20" class="active"></i>
                                @endwhile
                                @while($i-- >= 0)
                                <i data-feather="star" width="20" height="20" class=""></i>
                                @endwhile
                            </div>

                            <div class="font-weight-500 mt-5 font-14 text-instructor">
                                @if(!empty($instructor->bio))
                                {{ $instructor->bio }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
{{-- Instructor for Mobile Slider max.6 --}}
<section class="home-sections container instructor-mobile">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="font-30 font-weight-bold text-dark">{{ trans('home.instructors') }}</h2>
        </div>

        <a href="/instructors" class="btn btn-primary rounded-pill">{{ trans('home.all_instructors') }}</a>
    </div>

    <div class="position-relative mt-20 ltr">
        <div class="owl-carousel customers-testimonials instructors-swiper-container">

            @foreach($instructors as $instructor)
            <div class="item">
                <div class="shadow-effect">
                    <div class="instructors-card d-flex flex-column align-items-center justify-content-center">
                        <div class="instructors-card-avatar">
                            <img src="{{ $instructor->getAvatar(108) }}" alt="{{ $instructor->full_name }}" class="rounded-circle img-cover">
                        </div>
                        <div class="instructors-card-info mt-10 text-center">
                            <a href="{{ $instructor->getProfileUrl() }}" target="_blank">
                                <h3 class="font-16 font-weight-bold text-dark-blue">{{ $instructor->full_name }}</h3>
                            </a>

                            {{-- <p class="font-14 text-gray mt-5">{{ $instructor->bio }}</p> --}}
                            <div class="stars-card d-flex align-items-center justify-content-center mt-10">
                                @php
                                $i = 5;
                                @endphp
                                @while(--$i >= 5 - $instructor->rates())
                                <i data-feather="star" width="20" height="20" class="active"></i>
                                @endwhile
                                @while($i-- >= 0)
                                <i data-feather="star" width="20" height="20" class=""></i>
                                @endwhile
                            </div>

                            <div class="font-weight-500 mt-5 font-14 text-instructor">
                                @if(!empty($instructor->bio))
                                {{ $instructor->bio }}
                                @endif
                            </div>

                            {{-- @if(!empty($instructor->hasMeeting()))
                                                    <a href="{{ $instructor->getProfileUrl() }}?tab=appointments" class="btn btn-sm mt-15">{{ trans('home.reserve_a_live_class') }}</a>
                            @else
                            <a href="{{ $instructor->getProfileUrl() }}" class="btn btn-sm mt-15">{{ trans('public.profile') }}</a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif

{{-- Best Rate --}}
@if($homeSection->name == \App\Models\HomeSection::$best_rates and !empty($bestRateWebinars) and !$bestRateWebinars->isEmpty())
<section class="home-sections home-sections-swiper container">
    <div class="d-flex justify-content-between">
        <div>
            <h2 class="section-title section-title-bestrate">{{ trans('home.best_rates') }}</h2>
            {{-- <p class="section-hint">{{ trans('home.best_rates_hint') }}</p> --}}
        </div>

        <a href="/classes?sort=best_rates" class="btn btn-primary rounded-pill">{{ trans('home.view_all') }}</a>
    </div>

    <div class="mt-10 position-relative swiper-position">
        <div class="swiper-container best-rates-webinars-swiper px-12">
            <div class="swiper-wrapper py-20">
                @foreach($bestRateWebinars as $bestRateWebinar)
                <div class="swiper-slide">
                    @include('web.default.includes.webinar.grid-card',['webinar' => $bestRateWebinar])
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="swiper-pagination best-rates-webinars-swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

{{-- Map Testimoni --}}
@if($homeSection->name == \App\Models\HomeSection::$testimonials)
<section class="home-sections container sections-page-community">
    <div class="col-12">
        <div class="col-md-12 col-sm-12">
            <div class="d-flex justify-content-center align-items-center text-center flex-column h-section-card">
                <div class="card-user-community">
                    <div class="d-flex justify-content-center align-items-center text-center flex-column">
                        <div class="d-flex justify-content-center align-items-center text-center title-user-card pb-10">
                            <img src="{{ asset('assets/admin/img/home/community/love.svg') }}" alt="">
                            <p class="text-white ml-5">{{ trans('home.user_community_happier') }}</p>
                        </div>
                        <div class="d-flex text-center justify-content-center align-items-center">

                            @if (!empty($firstSectionTestimonials) && !$firstSectionTestimonials->isEmpty())
                            @foreach($firstSectionTestimonials as $testimonial)
                            <div class="size-profile-community m-0">
                                <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                            </div>
                            @endforeach
                            @else
                            <p>Testimoni belum tersedia</p>
                            @endif

                            @if(!empty($hiddenTestimonialsCount) && $hiddenTestimonialsCount > 0)
                            <div class="text-center ml-5">
                                <p class="text-white font-size-testimonials">+<span id="hiddenTestimonialsCount">{{ $hiddenTestimonialsCountFormatted }}</span></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="groups-profile-maps">
                <div class="d-flex justify-content-center align-items-center text-center flex-column container position-static position-profile-groups">
                    <div class="d-flex justify-content-between section-profile-top w-100">
                        <div class="item-profile">
                            <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                        </div>
                        <div class="item-profile">
                            <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                        </div>
                        <div class="item-profile">
                            <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex justify-content-around section-profile-bottom w-100">
                        <div class="item-profile">
                            <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                        </div>
                        <div class="item-profile">
                            <img src="{{ $testimonial->user_avatar }}" alt="{{ $testimonial->user_name }}" class="img-cover rounded-circle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endforeach

<div class='scrolltop'>
    <div class='d-flex scroll icon justify-content-center align-items-center'>
        <i class="fi fi-br-angle-small-up h-100"></i>
    </div>
</div>

<div id="myModal" class="modal-home-banner">
    <div id="modalContent" class="modal-content-banner">
        <div id="imgBanner" class="img-banner-card">
            <span class="close-banner" style="text-shadow: none"><i class="fi fi-rr-cross-circle"></i></span>
            <a id="bannerLink" href="#">
                <img class="img-cover img-banner" src="" alt="Banner Iklan">
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts_bottom')
<script>
    $(document).ready(function() {
        // Show or hide the scroll-to-top button based on scroll position
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.scrolltop').fadeIn();
            } else {
                $('.scrolltop').fadeOut();
            }
        });

        // Smooth scroll to top when button is clicked
        $('.scrolltop').click(function() {
            $('html, body').animate({scrollTop : 0}, 800);
            return false;
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("myModal");
        var closeButton = document.querySelector(".close-banner");
        var bannerLink = document.getElementById("bannerLink");

        var adsBanners = @json($adsBanners);
        var currentBannerIndex = 0;
        var closedBanners = [];

        function setBannerClosedCookie(index) {
            document.cookie = "bannerClosed_" + index + "=true; path=/";
        }

        function isBannerClosed(index) {
            var cookieName = "bannerClosed_" + index;
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                if (cookie.startsWith(cookieName + "=")) {
                    return true;
                }
            }
            return false;
        }

        function checkAndDisplayBanner() {
            while (currentBannerIndex < adsBanners.length && isBannerClosed(currentBannerIndex)) {
                currentBannerIndex++;
            }
            if (currentBannerIndex < adsBanners.length) {
                modal.style.display = "block";
                displayCurrentBanner();
            } else {
                modal.style.display = "none";
                setBannerClosedCookie(currentBannerIndex);
            }
        }

        function displayCurrentBanner() {
            var currentBanner = adsBanners[currentBannerIndex];
            bannerLink.href = currentBanner['url'];
            document.querySelector(".img-banner").src = currentBanner['image'];
        }

        checkAndDisplayBanner();

        closeButton.onclick = function() {
            closedBanners.push(currentBannerIndex);
            setBannerClosedCookie(currentBannerIndex);
            currentBannerIndex++;
            checkAndDisplayBanner();
        }

        modal.onclick = function(event) {
            if (event.target == modal) {
                closedBanners.push(currentBannerIndex);
                setBannerClosedCookie(currentBannerIndex);
                currentBannerIndex++;
                checkAndDisplayBanner();
            }
        }
    });
</script>
<script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>
<script src="/assets/default/vendors/owl-carousel2/owl.carousel.min.js"></script>
<script src="/assets/default/vendors/parallax/parallax.min.js"></script>
<script src="/assets/default/js/parts/home.min.js"></script>
@endpush