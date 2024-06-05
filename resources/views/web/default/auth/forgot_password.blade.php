@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('aaip/web/default/forgot_password.css') }}">
@endpush

@section('content')
    <section class="site-top-banner site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.forget_password') }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/"
                                            class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">
                                        {{ trans('auth.forget_password') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
    @endphp

    <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="login-card">
                    <div class="login-card-header text-center">
                        <h1 class="font-20 font-weight-bold mb-10">{{ trans('auth.forgot_password') }}</h1>
                        <p class="font-12 title_p">{{ trans('auth.forgot_password_p') }}</p>
                    </div>

                    <form method="post" action="/forget-password" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if ($registerMethod == 'mobile')
                            <div class="d-flex align-items-center wizard-custom-radio mb-20">
                                <div class="wizard-custom-radio-item flex-grow-1">
                                    <input type="radio" name="type" value="email" id="emailType" class=""
                                        {{ (empty(old('type')) or old('type') == 'email') ? 'checked' : '' }}>
                                    <label class="font-12 cursor-pointer px-15 py-10"
                                        for="emailType">{{ trans('public.email') }}</label>
                                </div>

                                <div class="wizard-custom-radio-item flex-grow-1">
                                    <input type="radio" name="type" value="mobile" id="mobileType" class=""
                                        {{ old('type') == 'mobile' ? 'checked' : '' }}>
                                    <label class="font-12 cursor-pointer px-15 py-10"
                                        for="mobileType">{{ trans('public.mobile') }}</label>
                                </div>
                            </div>
                        @endif

                        @if (session('success_message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success_message') }}
                            </div>
                        @endif

                        @if (!session('success_message'))
                            <div class="js-email-fields form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="input-label" for="email"></label>
                                <input name="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ old('email') }}" placeholder="{{ trans('auth.forgot_password_email') }}"
                                    aria-describedby="emailHelp">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        {{-- <div class="js-email-fields form-group {{ (old('type') == "mobile") ? 'd-none' : '' }}">
                        <label class="input-label" for="email"></label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               value="{{ old('email') }}" placeholder="{{ trans('auth.forgot_password_email') }}" aria-describedby="emailHelp">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}

                        @if ($registerMethod == 'mobile')
                            <div class="js-mobile-fields {{ old('type') == 'mobile' ? '' : 'd-none' }}">
                                @include('web.default.auth.register_includes.mobile_field')
                            </div>
                        @endif

                        @if (!empty(getGeneralSecuritySettings('captcha_for_forgot_pass')))
                            @include('web.default.includes.captcha_input')
                        @endif

                        <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.reset_password') }}</button>
                    </form>

                    <div class="text-center mt-20 d-flex justify-content-center">
                        <span class="text-secondary">
                            <a href="/login">
                                <div class="text-black font-14 d-flex align-items-center">
                                    <div class="">
                                        <i class="fi fi-ts-arrow-left mr-10" style="height: 35%; display: flex;"></i>
                                    </div>
                                    <div class="">
                                        {{ trans('auth.forgot_password_back') }}
                                    </div>
                                </div>
                            </a>
                        </span>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/js/parts/forgot_password.min.js"></script>
@endpush
