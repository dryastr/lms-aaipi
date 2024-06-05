@php
    $statisticsSettings = getStatisticsSettings();
@endphp

@if(!empty($statisticsSettings['enable_statistics']))
    @if(!empty($statisticsSettings['display_default_statistics']) and !empty($homeDefaultStatistics))    
        <section class="d-flex home-sections home-sections-swiper justify-content-center align-items-center text-center rating-section" id="bg-rating-section">
            <div class="rating-groups">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center align-items-center text-center flex-wrap">
                            <div class="rating-item flex-column text-center">
                                <div class="rating-icon mb-20">
                                    <img src="{{ asset('assets/admin/img/home/rating/courses-laptop.svg') }}" alt="">
                                </div>
                                <div class="rating-total text-white">
                                    <h1 class="mb-5">{{ $homeDefaultStatistics['offlineCourseCount'] }}</h1>
                                    <p>{{ trans('home.learning_online') }}</p>
                                </div>
                            </div>
                            <div class="line-space-rating"></div>
                            <div class="rating-item flex-column text-center">
                                <div class="rating-icon mb-20">
                                    <img src="{{ asset('assets/admin/img/home/rating/cont-certificate.svg') }}" alt="">
                                </div>
                                <div class="rating-total text-white">
                                    <h1 class="mb-5">{{ $homeDefaultStatistics['skillfulTeachersCount'] }}</h1>
                                    <p>{{ trans('home.cont_certif') }}</p>
                                </div>
                            </div>
                            <div class="line-space-rating"></div>
                            <div class="rating-item flex-column text-center">
                                <div class="rating-icon mb-20">
                                    <img src="{{ asset('assets/admin/img/home/rating/books-lamp.svg') }}" alt="">
                                </div>
                                <div class="rating-total text-white">
                                    <h1 class="mb-5">{{ $homeDefaultStatistics['liveClassCount'] }}</h1>
                                    <p>{{ trans('home.learning_user') }}</p>
                                </div>
                            </div>
                            <div class="line-space-rating"></div>
                            <div class="rating-item flex-column text-center">
                                <div class="rating-icon mb-20">
                                    <img src="{{ asset('assets/admin/img/home/rating/top-succes.svg') }}" alt="">
                                </div>
                                <div class="rating-total text-white">
                                    <h1 class="mb-5">{{ $homeDefaultStatistics['studentsCount'] }}</h1>
                                    <p>{{ trans('home.succes_level') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@else
    <div class="my-40"></div>
@endif

