@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/instructors.css">
@endpush


@section('content')
    <section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings($page) }}" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ trans('site.kontributor') }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('site.kontributor') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">

        @if(!empty($bestRateInstructors) and !$bestRateInstructors->isEmpty() and (empty(request()->get('sort')) or !in_array(request()->get('sort'),['top_rate','top_sale'])))
            <section class="mt-30 pt-30">
                <p class="font-weight-500 text-instructor font-5 mt-90 d-flex justify-content-center">{{ trans('site.desc_kontributor_ahli') }}</p>
                <h3 class="font-24 font-weight-bold text-dark-blue d-flex justify-content-center align-items-center">{{ trans('site.title_kontributor_ahli_kami') }}</h3>

                <div class="position-relative mt-20">
                    <div id="bestRateInstructorsSwiper" class="swiper-container px-12">
                        <div class="d-flex swiper-wrapper pb-20">

                            @foreach($bestRateInstructors as $bestRateInstructor)
                                <div class="swiper-slide">
                                    @include('web.default.pages.instructor_card',['instructor' => $bestRateInstructor])
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="mt-50 pt-30">
                            {{ $bestRateInstructors->appends(request()->input())->links('vendor.pagination.panel') }}
                        </div>
                    </div>
                </div>

            </section>
        @endif
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script src="/assets/default/js/parts/instructors.min.js"></script>
@endpush
