@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel="stylesheet" href="/assets/default/css/css-stars.css">
    <link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/blog.css">
    <style>
        #course-teacher-custom{
            margin: 0;
        }
    </style>
@endpush

@section('content')
<section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-12 col-md-9 col-lg-7">
                <div class="top-search-categories-form">
                    <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.detail_resource') }}</h1>
                    <div class="d-flex align-items-center justify-content-center text-center mt-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.detail_resource') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container course-content-section">
    <div class="row flex-wrap-reverse">
        <div class="col-12 col-md-12">
            <div class="course-content-body user-select-none" style="margin-top: 300px">
                <div class="course-body-on-cover">
                    <h1 class="font-30 course-title">
                        {{ str_replace('-', ' ', $resource->title) }}
                    </h1>
                </div>

                <div class="mt-35">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ (empty(request()->get('tab','')) or request()->get('tab','') == 'information') ? 'show active' : '' }} " id="information" role="tabpanel"
                             aria-labelledby="information-tab">
                            @include(getTemplate().'.course.tabs.information')
                                @if (session('error'))
                                <div class="toast-container">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="toast alert alert-danger show w-100" role="alert">
                                            <div class="d-flex align-items-center">
                                                <div class="icon-alert-msg">
                                                    <i class="fi fi-ss-circle-xmark"></i>
                                                </div>
                                                <div class="alert-msg">
                                                    {{ session('error') }}
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="toast" aria-label="Close">
                                                <i class="fi fi-sr-cross-small"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            <a href="{{ route('download.pdf', ['resourceId' => $resource->id]) }}" class="btn btn-primary">Download PDF</a>
                            <h2 class="ml-lg-30 mt-50 mt-lg-50">{{ trans('public.pengajar') }}</h2>
                            @include(getTemplate().'.course.sidebar_instructor_profile', ['courseTeacher' => $resource->user])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts_bottom')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.querySelector('.toast');
        const closeButton = document.querySelector('.close');

        if (toast) {
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 500); 
            }, 5000);

            closeButton.addEventListener('click', () => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 500); 
            });
        }
    });
</script>
@endpush