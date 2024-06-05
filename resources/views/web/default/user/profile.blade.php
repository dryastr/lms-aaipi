@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/persian-datepicker/persian-datepicker.min.css"/>
    <link rel="stylesheet" href="/assets/default/css/css-stars.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/instructors.css">
@endpush


@section('content')
<section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
     <div class="container h-100">
         <div class="row h-100 align-items-center justify-content-center text-center">
             <div class="col-12 col-md-9 col-lg-7">
                 <div class="top-search-categories-form">
                     <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.detail_kontributor') }}</h1>
                     <div class="d-flex align-items-center justify-content-center mt-5">
                         <nav aria-label="breadcrumb">
                             <ol class="breadcrumb p-0 m-0">
                                 <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                 <li class="breadcrumb-item text-dark-blue" aria-current="page"><a href="/instructors" class=" text-dark-blue">{{ trans('site.kontributor') }}</a></li>
                                 <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.detail_kontributor') }}</li>
                             </ol>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
    {{-- <section class="site-top-banner position-relative">
        <img src="{{ $user->getCover() }}" class="img-cover" alt=""/>
    </section>
     --}}


    <section class="container mt-30">
        <div class="rounded-lg px-25 py-20 px-lg-50 py-lg-35 user-profile-info bg-white">
            <div class="profile-info-box d-flex align-items-start justify-content-between">
                <div class="user-details d-flex">
                    <div class="user-profile">
                        <img src="{{ $user->getAvatar(190) }}" class="img-cover image-profile" alt="{{ $user['full_name'] }}">
                        @if($user->offline)
                            <span class="user-circle-badge unavailable d-flex align-items-center justify-content-center">
                                <i data-feather="slash" width="20" height="20" class="text-white"></i>
                            </span>
                        @elseif($user->verified)
                            <span class="user-circle-badge has-verified d-flex align-items-center justify-content-center">
                                <i data-feather="check" width="20" height="20" class="text-white"></i>
                            </span>
                        @endif
                    </div>
                    <div class="ml-20 ml-lg-40 title-image">
                        <h1 class="font-24 font-weight-bold text-dark-blue ">{{ $user["full_name"] }}</h1>
                        {{-- <span class="text-gray font-14 ">Pemasaran, Pengembangan Web,Pengembangan Seluler,Pengembangan Permainan</span> --}}
                        <span class="text-gray">{{ $user["headline"] }}</span>

                        <div class="stars-card d-flex align-items-center ">
                            @include('web.default.includes.webinar.rate',['rate' => $userRates])
                        </div>
                            <div class="d-flex flex-column followers-status mt-15">
                                {{-- <span class="font-14 text-gray">{{ trans('panel.followers') }}</span> --}}
                              <span class="font-14 text-gray text-image"> {!! nl2br($user->about) !!}
                                </span>
                              </div>
                    </div>
                </div>    
        </div>

            {{-- <div class="mt-40 border-top"></div> --}}

            <div  class="row mt-30 w-100 mt-md-50 d-flex align-items-center justify-content-around"  >
                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon orange p-15 rounded-lg">
                        <img src="/assets/default/img/profile/students.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5">{{ $user->students_count }}</span>
                    <span class="font-14 text-gray">{{ trans('quiz.students') }}</span>
                </div>

                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon blue p-15 rounded-lg">
                        <img src="/assets/default/img/profile/webinars.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5">{{ count($webinars) }}</span>
                    <span class="font-14 text-gray">{{ trans('webinars.classes') }}</span>
                </div>

                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon green p-15 rounded-lg">
                        <img src="/assets/default/img/profile/reviews.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5">{{ $user->reviewsCount() }}</span>
                    <span class="font-14 text-gray">{{ trans('product.reviews') }}</span>
                </div>


                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center" >
                    <div class="state-icon royalblue p-15 rounded-lg">
                        <img src="/assets/default/img/profile/appointments.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5">{{ $appointments }}</span>
                    <span class="font-14 text-gray">{{ trans('site.appointments') }}</span>
                </div>
            </div>
        </div>
        
            <div class="title-skill container mt-30">
                <section class="pt-50 skill-items">
                    <ul class="nav nav-tabs d-flex align-items-center  px-lg-50" id="tabs-tab" role="tablist">
                    <div class="tab-content" id="nav-tabContent">
                @if(!empty($occupations) and !$occupations->isEmpty())
                    <div class="mt-40">
                        <h3  class="text-skill font-16 text-dark-blue font-weight-bold">{{ trans('site.occupations') }}</h3>
                        <div class="d-flex flex-column  pt-10">
                            @foreach($occupations as $occupation)
                                <div class="d-flex align-items-center font-14 mt-10">
                                    <img src="/assets/aaipi/img/ceklis.svg" alt="Category Image" class="mr-10" style="max-width: 30px; max-height: 20px;">
                                    {{ $occupation->category->title }}
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="d-flex flex-column pt-10">
                            @foreach($occupations as $occupation)
                                <div class="font-14 mt-10">{{ $occupation->category->title }}</div>
                            @endforeach
                        </div> --}}
                    </div>
                @endif
                 </div>
                </section>
            </div>
    </section>
    <br>
    <br>
    <br>

    @include('web.default.user.send_message_modal')

@endsection

@push('scripts_bottom')
    <script>
        var unFollowLang = '{{ trans('panel.unfollow') }}';
        var followLang = '{{ trans('panel.follow') }}';
        var reservedLang = '{{ trans('meeting.reserved') }}';
        var availableDays = {{ json_encode($times) }};
        var messageSuccessSentLang = '{{ trans('site.message_success_sent') }}';
    </script>

    <script src="/assets/default/vendors/persian-datepicker/persian-date.js"></script>
    <script src="/assets/default/vendors/persian-datepicker/persian-datepicker.js"></script>

    <script src="/assets/default/js/parts/profile.min.js"></script>

    @if(!empty($user->live_chat_js_code) and !empty(getFeaturesSettings('show_live_chat_widget')))
        <script>
            (function () {
                "use strict"

                {!! $user->live_chat_js_code !!}
            })(jQuery)
        </script>
    @endif
@endpush
