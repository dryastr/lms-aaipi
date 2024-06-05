@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/css/css-stars.css">
    <link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">
@endpush


@section('content')
<section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
     <div class="container h-100">
         <div class="row h-100 align-items-center position-title-content-course">
             <div class="col-12 col-md-9 col-lg-7">
                 <div class="top-search-categories-form">
                     <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.detail_course') }}</h1>
                     <div class="d-flex align-items-center position-title-content-course mt-5">
                         <nav aria-label="breadcrumb">
                             <ol class="breadcrumb p-0 m-0">
                                 <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                 <li class="breadcrumb-item text-dark-blue"><a href="/classes?sort=newest" class=" text-dark-blue">Kursus</a></li>
                                 <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.detail_course') }}</li>
                             </ol>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 

    {{-- <section class="course-cover-container {{ empty($activeSpecialOffer) ? 'not-active-special-offer' : '' }}">
        <img src="{{ $course->getImageCover() }}" class="img-cover course-cover-img" alt="{{ $course->title }}"/>

        <div class="cover-content pt-40">
            <div class="container position-relative">
                @if(!empty($activeSpecialOffer))
                    @include('web.default.course.special_offer')
                @endif
            </div>
        </div>
    </section> --}}

    <section class="container course-content-section {{ $course->type }} {{ ($hasBought or $course->isWebinar()) ? 'has-progress-bar' : '' }}">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="course-content-body user-select-none" style="margin-top: 300px">
                    <div class="course-body-on-cover"   >
                        <h1 class="font-30 course-title">
                            {{ $course->title }}
                            {{-- {{ clean($course->title, 't') }} --}}
                        </h1>

                 

                        <div class="d-flex align-items-center">
                            @include('web.default.includes.webinar.rate',['rate' => $course->getRate()])
                            <span class="font-14">({{ $course->reviews->pluck('creator_id')->count() }} {{ trans('public.ratings') }})</span>
                        </div>


                        @php
                            $percent = $course->getProgress();
                        @endphp

                        @if($hasBought or $percent)
                            <div class="mt-30 d-flex align-items-center">
                                <div class="progress course-progress flex-grow-1 shadow-xs rounded-sm">
                                    <span class="progress-bar rounded-sm bg-warning" style="width: {{ $percent }}%"></span>
                                </div>

                                <span class="ml-15 font-14 font-weight-500">
                                    @if($hasBought and (!$course->isWebinar() or $course->isProgressing()))
                                        {{ trans('public.course_learning_passed',['percent' => $percent]) }}
                                    @elseif(!is_null($course->capacity))
                                        {{ $course->sales_count }}/{{ $course->capacity }} {{ trans('quiz.students') }}
                                    @else
                                        {{ trans('public.course_learning_passed',['percent' => $percent]) }}
                                    @endif
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-35">
                        <ul class="nav nav-tabs rounded-sm p-15 d-flex align-items-center justify-content-between" id="tabs-tab" role="tablist">
                            <li class="nav-item">
                                <a class="position-relative font-14  {{ (empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'active' : '' }}" id="information-tab"
                                   data-toggle="tab" href="#information" role="tab" aria-controls="information"
                                   aria-selected="true">{{ trans('product.information') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14  {{ (request()->get('tab','') == 'content') ? 'active' : '' }}" id="content-tab" data-toggle="tab"
                                   href="#content" role="tab" aria-controls="content"
                                   aria-selected="false">{{ trans('product.content') }} ({{ $webinarContentCount }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="position-relative font-14  {{ (request()->get('tab','') == 'reviews') ? 'active' : '' }}" id="reviews-tab" data-toggle="tab"
                                   href="#reviews" role="tab" aria-controls="reviews"
                                   aria-selected="false">{{ trans('product.reviews') }} ({{ $course->reviews->count() > 0 ? $course->reviews->pluck('creator_id')->count() : 0 }})</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade {{ (empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'show active' : '' }} " id="information" role="tabpanel"
                                 aria-labelledby="information-tab">
                                @include(getTemplate().'.course.tabs.information')
                                <h2 class="ml-lg-30 mt-50 mt-lg-50">{{ trans('public.pengajar') }}</h2>
                                @include(getTemplate().'.course.sidebar_instructor_profile', ['courseTeacher' => $course->teacher])
                            </div>
                            <div class="tab-pane fade {{ (request()->get('tab','') == 'content') ? 'show active' : '' }}" id="content" role="tabpanel" aria-labelledby="content-tab">
                                @include(getTemplate().'.course.tabs.content', ['course' => $course])
                            </div>
                            <div class="tab-pane fade {{ (request()->get('tab','') == 'reviews') ? 'show active' : '' }}" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                @include(getTemplate().'.course.tabs.reviews')
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="course-content-sidebar course-index-sidebar col-12 col-lg-4 mt-25 mt-lg-50">
                <div class="rounded-lg shadow-sm">
                    <div class="course-img {{ $course->video_demo ? 'has-video' :'' }}">

                        <img src="{{ $course->getImage() }}" class="img-cover" alt="">

                        @if($course->video_demo)
                            <div id="webinarDemoVideoBtn"
                                 data-video-path="{{ $course->video_demo_source == 'upload' ?  url($course->video_demo) : $course->video_demo }}"
                                 data-video-source="{{ $course->video_demo_source }}"
                                 class="course-video-icon cursor-pointer d-flex align-items-center justify-content-center">
                                <i data-feather="play" width="25" height="25"></i>
                            </div>
                        @endif
                    </div>

                    <div class="px-20 pb-30">
                        <form action="/cart/store" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="item_id" value="{{ $course->id }}">
                            <input type="hidden" name="item_name" value="webinar_id">

                            @if(!empty($course->tickets))
                                @foreach($course->tickets as $ticket)

                                    <div class="form-check mt-20">
                                        <input class="form-check-input" @if(!$ticket->isValid()) disabled @endif type="radio"
                                               data-discount-price="{{ handlePrice($ticket->getPriceWithDiscount($course->price, !empty($activeSpecialOffer) ? $activeSpecialOffer : null)) }}"
                                               value="{{ ($ticket->isValid()) ? $ticket->id : '' }}"
                                               name="ticket_id"
                                               id="courseOff{{ $ticket->id }}">
                                        <label class="form-check-label d-flex flex-column cursor-pointer" for="courseOff{{ $ticket->id }}">
                                            <span class="font-16 font-weight-500 text-dark-blue">{{ $ticket->title }} @if(!empty($ticket->discount))
                                                    ({{ $ticket->discount }}% {{ trans('public.off') }})
                                                @endif</span>
                                            <span class="font-14 text-gray">{{ $ticket->getSubTitle() }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @endif

                            <div class="d-flex justify-content-between align-items-center text-center mt-20">
                                <div class="price-upcominggg">
                                    @if($course->price > 0)
                                    <div id="priceBox" class="{{ !empty($activeSpecialOffer) ? ' flex-column ' : '' }}">
                                        <div class="d-flex">
                                            @php
                                                $realPrice = handleCoursePagePriceGuest($course->price_guest);
                                            @endphp
                                            @if(!$user)
                                                @if($realPrice['price_guest'] > 0)
                                                <span id="realPrice" data-value="{{ $course->price_guest }}"
                                                    data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                                    class="d-block @if(!empty($activeSpecialOffer)) font-16 text-gray text-decoration-line-through @else font-30  @endif">
                                                    {{ $realPrice['price_guest'] }}
                                                </span>
                                                @else
                                                <span id="realPrice" data-value="{{ $course->price_guest }}"
                                                    data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                                    class="d-block font-36 text-primary">
                                                    {{ trans('public.free') }}
                                                </span>
                                                @endif
                                                @if(!empty($realPrice['tax']) and empty($activeSpecialOffer))
                                                    <span class="ml-35 mt-10 d-block font-14 text-gray">+ {{ $realPrice['tax'] }} {{ trans('cart.guest') }}</span>
                                                @endif
                                            @elseif ($user && !$user->is_member_aaipi)
                                                @php
                                                    $GuestPrice = handleCoursePagePriceGuest($course->price_guest);
                                                @endphp
                                                @if($GuestPrice['price_guest'] > 0)
                                                    <span id="realPrice" data-value="{{ $course->price_guest }}"
                                                        data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                                        class="d-block @if(!empty($activeSpecialOffer)) font-16 text-gray text-decoration-line-through @else font-30  @endif">
                                                        {{ $GuestPrice['price_guest'] }}
                                                    </span>
                                                @else
                                                    <span id="realPrice" data-value="{{ $course->price_guest }}"
                                                        data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                                        class="d-block font-36 text-primary">
                                                        {{ trans('public.free') }}
                                                    </span>
                                                @endif`
                                            @else
                                             @php
                                                 $PriceMember = handleCoursePagePrice($course->price);
                                            @endphp
                                                <span id="realPrice" data-value="{{ $course->price }}"
                                                    data-special-offer="{{ !empty($activeSpecialOffer) ? $activeSpecialOffer->percent : ''}}"
                                                    class="d-block @if(!empty($activeSpecialOffer)) font-16 text-gray text-decoration-line-through @else font-30  @endif">
                                                    {{ $PriceMember['price'] }}
                                                </span>
                                            @endif
                                        </div>

                                        @if(!empty($activeSpecialOffer))
                                            <div class="d-flex">
                                                @php
                                                    $priceWithDiscount = handleCoursePagePrice($course->getPrice());
                                                @endphp
                                                <span id="priceWithDiscount"
                                                    class="d-block font-30  ">
                                                    {{ $priceWithDiscount['price'] }}
                                                </span>
                                
                                                @if(!empty($priceWithDiscount['tax']))
                                                    <span class="mt-10 ml-35 font-14 text-gray">+ {{ $priceWithDiscount['tax'] }} {{ trans('cart.member_aaip') }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center mt-20">
                                        <span class="font-36 text-primary">{{ trans('public.free') }}</span>
                                    </div>
                                @endif
                                
                                </div>
                                <div class="cart-upcomingggg">
                                    @if(auth()->check())
                                        <button type="submit" class="js-course-add-to-cart-btn-custom btn-cart-custom">
                                            <i data-feather="shopping-cart" width="30" height="30"></i>
                                        </button>
                                    @else
                                        <a href="/login" class="">
                                            <i data-feather="shopping-cart" width="30" height="30"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @php
                                $canSale = ($course->canSale() and !$hasBought);
                            @endphp
        
                            <div class="mt-20 d-flex flex-column">
                                @if(!$canSale and $course->canJoinToWaitlist())
                                    <button type="button" data-slug="{{ $course->slug }}" class="btn btn-primary {{ (!empty($authUser)) ? 'js-join-waitlist-user' : 'js-join-waitlist-guest' }}">{{ trans('update.join_waitlist') }}</button>
                                @elseif($hasBought or !empty($course->getInstallmentOrder()))
                                    <a href="{{ $course->getLearningPageUrl() }}" class="btn btn-primary">{{ trans('update.go_to_learning_page') }}</a>
                                @elseif($course->price > 0)

                                    @if($canSale and $course->subscribe)
                                        <a href="/subscribes/apply/{{ $course->slug }}" class="btn btn-primary mt-20 @if(!$canSale) disabled @endif">{{ trans('public.subscribe') }}</a>
                                    @endif

                                    @if($canSale and !empty($course->points))
                                        <a href="{{ !(auth()->check()) ? '/login' : '#' }}" class="{{ (auth()->check()) ? 'js-buy-with-point' : '' }} btn btn-outline-warning mt-20 {{ (!$canSale) ? 'disabled' : '' }}" rel="nofollow">
                                            {!! trans('update.buy_with_n_points',['points' => $course->points]) !!}
                                        </a>
                                    @endif

                                    @if($canSale and !empty(getFeaturesSettings('direct_classes_payment_button_status')))
                                        <button type="button" class="btn btn-outline-danger mt-20 js-course-direct-payment">
                                            {{ trans('update.buy_now') }}
                                        </button>
                                    @endif

                                    @if(!empty($installments) and count($installments) and getInstallmentsSettings('display_installment_button'))
                                        <a href="/course/{{ $course->slug }}/installments" class="btn btn-outline-primary mt-20">
                                            {{ trans('update.pay_with_installments') }}
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ $canSale ? '/course/'. $course->slug .'/free' : '#' }}" class="btn btn-primary {{ (!$canSale) ? (' disabled ' . $course->cantSaleStatus($hasBought)) : '' }}">{{ trans('public.enroll_on_webinar') }}</a>
                                @endif
                            </div>

                        </form>


                        <div class="mt-35 d-flex flex-column">
                           

                            @if($course->quizzes->where('certificate', 1)->count() > 0)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="award" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.official_certificate') }}</span>
                                </div>
                            @endif

                            @if($course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count() > 0)
                                <div class="mt-20 d-flex align-items-center text-gray">
                                    <i data-feather="file-text" width="20" height="20"></i>
                                    <span class="ml-5 font-14 font-weight-500">{{ trans('webinars.online_quizzes_count',['quiz_count' => $course->quizzes->where('status', \App\models\Quiz::ACTIVE)->count()]) }}</span>
                                </div>
                            @endif

                           
                        </div>

                        
                      
                    </div>
                    <div class="d-flex justify-content-around border-top border-gray250 ">
                        @if($course->isWebinar())
                            <div class="col">
                                <a href="{{ $course->addToCalendarLink() }}" target="_blank" class="d-flex flex-column align-items-center text-center text-gray">
                                    <i data-feather="calendar" width="20" height="20"></i>
                                    <span class="font-14" >{{ trans('public.reminder') }}</span>
                                </a>
                            </div>
                        @endif
    
                        <div class="d-flex flex-column">
                            <div class="d-flex mb-20 mt-20">
                                <a href="/favorites/{{ $course->slug }}/toggle" id="favoriteToggle" class="d-flex align-items-center text-gray">
                                    <i data-feather="heart" class="{{ !empty($isFavorite) ? 'favorite-active' : '' }}" width="20" height="20"></i>
                                    <span class="font-12 ml-5">{{ trans('panel.detail_pelatihan') }}</span>
                                </a>
                            </div>
        
                            <div class="d-flex align-items-center justify-content-center mb-20 mt-20">
                                <a href="#" class="js-share-course d-flex text-gray" onclick="shareCount('{{ $course->slug }}')">
                                    <i data-feather="share-2" width="20" height="20"></i>
                                    <span class="font-12 mx-5">{{ trans('public.share') }}</span>
                                    <span class="share-count" style="font-size: 15px">({{ $course->share_count }})</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
           
                {{-- Cashback Alert --}}
                @include('web.default.includes.cashback_alert',['itemPrice' => $course->price])

                {{-- Gift Card --}}
                @if($course->canSale() and !empty(getGiftsGeneralSettings('status')) and !empty(getGiftsGeneralSettings('allow_sending_gift_for_courses')))
                    <a href="/gift/course/{{ $course->slug }}" class="d-flex align-items-center mt-30 rounded-lg border p-15">
                        <div class="size-40 d-flex-center rounded-circle bg-gray200">
                            <i data-feather="gift" class="text-gray" width="20" height="20"></i>
                        </div>
                        <div class="ml-5">
                            <h4 class="font-14 font-weight-bold text-gray">{{ trans('update.gift_this_course') }}</h4>
                            <p class="font-12 text-gray">{{ trans('update.gift_this_course_hint') }}</p>
                        </div>
                    </a>
                @endif
                
                @if(Auth::check() && $course->is_live_streaming)
                    <div class="rounded-lg shadow-sm mt-35 d-flex">
                        <div class="offline-icon offline-icon-left d-flex align-items-stretch">
                            <div class="d-flex align-items-center">
                                <img src="/assets/default/img/profile/zoom-img.png" alt="offline">
                            </div>
                        </div>
                
                        <div class="p-30">
                            <h3 class="font-16 text-dark-blue mb-15">{{ trans('public.url_live_zoom') }}</h3>
                            <a href="{{ $course->live_streaming_url }}" class="font-14 font-bold text-black mt-50">{{trans('public.klik_disini_url_live_zoom')}}</a>
                        </div>
                    </div>
                @endif
            
                @if($course->teacher->offline)
                    <div class="rounded-lg shadow-sm mt-35 d-flex">
                        <div class="offline-icon offline-icon-left d-flex align-items-stretch">
                            <div class="d-flex align-items-center">
                                <img src="/assets/default/img/profile/time-icon.png" alt="offline">
                            </div>
                        </div>

                        <div class="p-15">
                            <h3 class="font-16 text-dark-blue">{{ trans('public.instructor_is_not_available') }}</h3>
                            <p class="font-14 font-weight-500 text-gray mt-15">{{ $course->teacher->offline_message }}</p>
                        </div>
                    </div>
                @endif

                
                {{-- @if($course->webinarPartnerTeacher->count() > 0)
                    @foreach($course->webinarPartnerTeacher as $webinarPartnerTeacher)
                        @include('web.default.course.sidebar_instructor_profile', ['courseTeacher' => $webinarPartnerTeacher->teacher])
                    @endforeach
                @endif --}}
               
            </div>
        </div>

        {{-- Ads Bannaer --}}
        @if(!empty($advertisingBanners) and count($advertisingBanners))
            <div class="mt-30 mt-md-50">
                <div class="row">
                    @foreach($advertisingBanners as $banner)
                        <div class="col-{{ $banner->size }}">
                            <a href="{{ $banner->link }}">
                                <img src="{{ $banner->image }}" class="img-cover rounded-sm" alt="{{ $banner->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        {{-- ./ Ads Bannaer --}}
    </section>

    <div id="webinarReportModal" class="d-none">
        <h3 class="section-title after-line font-20 text-dark-blue">{{ trans('product.report_the_course') }}</h3>

        <form action="/course/{{ $course->id }}/report" method="post" class="mt-25">

            <div class="form-group">
                <label class="text-dark-blue font-14">{{ trans('product.reason') }}</label>
                <select id="reason" name="reason" class="form-control">
                    <option value="" selected disabled>{{ trans('product.select_reason') }}</option>

                    @foreach(getReportReasons() as $reason)
                        <option value="{{ $reason }}">{{ $reason }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label class="text-dark-blue font-14" for="message_to_reviewer">{{ trans('public.message_to_reviewer') }}</label>
                <textarea name="message" id="message_to_reviewer" class="form-control" rows="10"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <p class="text-gray font-16">{{ trans('product.report_modal_hint') }}</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-course-report-submit btn btn-sm btn-primary">{{ trans('panel.report') }}</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">{{ trans('public.close') }}</button>
            </div>
        </form>
    </div>

    @include('web.default.course.share_modal')
    @include('web.default.course.buy_with_point_modal')
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/parts/time-counter-down.min.js"></script>
    <script src="/assets/default/vendors/barrating/jquery.barrating.min.js"></script>
    <script src="/assets/default/vendors/video/video.min.js"></script>
    <script src="/assets/default/vendors/video/youtube.min.js"></script>
    <script src="/assets/default/vendors/video/vimeo.js"></script>

    <script>
        var webinarDemoLang = '{{ trans('webinars.webinar_demo') }}';
        var replyLang = '{{ trans('panel.reply') }}';
        var closeLang = '{{ trans('public.close') }}';
        var saveLang = '{{ trans('public.save') }}';
        var reportLang = '{{ trans('panel.report') }}';
        var reportSuccessLang = '{{ trans('panel.report_success') }}';
        var reportFailLang = '{{ trans('panel.report_fail') }}';
        var messageToReviewerLang = '{{ trans('public.message_to_reviewer') }}';
        var copyLang = '{{ trans('public.copy') }}';
        var copiedLang = '{{ trans('public.copied') }}';
        var learningToggleLangSuccess = '{{ trans('public.course_learning_change_status_success') }}';
        var learningToggleLangError = '{{ trans('public.course_learning_change_status_error') }}';
        var notLoginToastTitleLang = '{{ trans('public.not_login_toast_lang') }}';
        var notLoginToastMsgLang = '{{ trans('public.not_login_toast_msg_lang') }}';
        var notAccessToastTitleLang = '{{ trans('public.not_access_toast_lang') }}';
        var notAccessToastMsgLang = '{{ trans('public.not_access_toast_msg_lang') }}';
        var canNotTryAgainQuizToastTitleLang = '{{ trans('public.can_not_try_again_quiz_toast_lang') }}';
        var canNotTryAgainQuizToastMsgLang = '{{ trans('public.can_not_try_again_quiz_toast_msg_lang') }}';
        var canNotDownloadCertificateToastTitleLang = '{{ trans('public.can_not_download_certificate_toast_lang') }}';
        var canNotDownloadCertificateToastMsgLang = '{{ trans('public.can_not_download_certificate_toast_msg_lang') }}';
        var sessionFinishedToastTitleLang = '{{ trans('public.session_finished_toast_title_lang') }}';
        var sessionFinishedToastMsgLang = '{{ trans('public.session_finished_toast_msg_lang') }}';
        var sequenceContentErrorModalTitle = '{{ trans('update.sequence_content_error_modal_title') }}';
        var courseHasBoughtStatusToastTitleLang = '{{ trans('cart.fail_purchase') }}';
        var courseHasBoughtStatusToastMsgLang = '{{ trans('site.you_bought_webinar') }}';
        var courseNotCapacityStatusToastTitleLang = '{{ trans('public.request_failed') }}';
        var courseNotCapacityStatusToastMsgLang = '{{ trans('cart.course_not_capacity') }}';
        var courseHasStartedStatusToastTitleLang = '{{ trans('cart.fail_purchase') }}';
        var courseHasStartedStatusToastMsgLang = '{{ trans('update.class_has_started') }}';
        var joinCourseWaitlistLang = '{{ trans('update.join_course_waitlist') }}';
        var joinCourseWaitlistModalHintLang = "{{ trans('update.join_course_waitlist_modal_hint') }}";
        var joinLang = '{{ trans('footer.join') }}';
        var nameLang = '{{ trans('auth.name') }}';
        var emailLang = '{{ trans('auth.email') }}';
        var phoneLang = '{{ trans('public.phone') }}';
        var captchaLang = '{{ trans('site.captcha') }}';
    </script>

    <script src="/assets/default/js/parts/comment.min.js"></script>
    <script src="/assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="/assets/default/js/parts/webinar_show.min.js"></script>
    <script>
        function shareCount(slug) {
            $.ajax({
                url: '/course/' + slug + '/share-count',
                type: 'GET',
                success: function(response) {
                    console.log('Share count incremented successfully.');
                    // $('.share-count').text(response.share_count);
                },
                error: function(xhr, status, error) {
                    console.error('Error incrementing share count:', error);
                }
            });
        }
    </script>

    @if(!empty($course->creator) and !empty($course->creator->live_chat_js_code) and !empty(getFeaturesSettings('show_live_chat_widget')))
        <script>
            (function () {
                "use strict"

                {!! $course->creator->live_chat_js_code !!}
            })(jQuery)
        </script>
    @endif
@endpush
