@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/auth/style.css">
@endpush

@section('content')
    <section
        class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.login') }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/"
                                            class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">
                                        {{ trans('auth.login') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('web.default.auth.header', ['pageTitle' => 'Login', 'pageSubtitle' => 'Beranda > Login']) --}}

    <div class="container">
        @if (!empty(session()->has('msg')))
            <div class="alert alert-info alert-dismissible fade show mt-30" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row login-container justify-content-center">

            {{-- <div class="col-12 col-md-6 pl-0"> --}}
            {{-- <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login"> --}}
            {{-- </div> --}}

            <div class="col-12 col-md-7">
                <div class="py-20">
                    <h1 class=" text-center font-25 font-weight-bold">{{ trans('auth.login_h1') }}</h1>
                    <p class="text-center mb-50">{{ trans('auth.p') }}</p>

                    <form method="Post" action="/login" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="input-label" for="username"></label>
                            <input name="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                value="{{ old('username') }}" placeholder="{{ trans('auth.email_or_mobile') }}"
                                aria-describedby="emailHelp">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="position-styeles">
                                <input name="password" type="password"
                                    class="form-control  @error('password')  is-invalid @enderror"
                                    placeholder="{{ trans('auth.password') }}" id="form_password"
                                    aria-describedby="passwordHelp">
                                <button type="button" class="btn-eye-password-register" id="togglePassword"><i id="passwordIcon"
                                        class="fa fa-eye"></i>
                                </button>
                            </div>
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="form-check d-flex justify-content-between mb-3">
                    <div>
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label font-14" for="remember">{{ trans('auth.remember_me') }}</label>
                    </div>
                    <a href="/forget-password" class="font-14">{{ trans('auth.forget_password') }}</a>
                </div>



                @if (!empty(getGeneralSecuritySettings('captcha_for_login')))
                    @include('web.default.includes.captcha_input')
                @endif

                <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.login') }}</button>
                </form>

                @if (session()->has('login_failed_active_session'))
                    <div class="d-flex align-items-center mt-20 p-15 danger-transparent-alert ">
                        <div class="danger-transparent-alert__icon d-flex align-items-center justify-content-center">
                            <i data-feather="alert-octagon" width="18" height="18" class=""></i>
                        </div>
                        <div class="ml-10">
                            <div class="font-14 font-weight-bold ">
                                {{ session()->get('login_failed_active_session')['title'] }}</div>
                            <div class="font-12 ">{{ session()->get('login_failed_active_session')['msg'] }}</div>
                        </div>
                    </div>
                @endif

                {{-- <div class="text-center mt-20">
                        <span class="badge badge-circle-gray300 text-secondary d-inline-flex align-items-center justify-content-center">{{ trans('auth.or') }}</span>
                    </div> --}}

                {{-- @if (!empty(getFeaturesSettings('show_google_login_button')))
                    <a href="/google" target="_blank"
                        class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center">
                        <img src="/assets/default/img/auth/google.svg" class="mr-auto" alt=" google svg" />
                        <span class="flex-grow-1">{{ trans('auth.google_login') }}</span>
                    </a>
                @endif --}}

                {{-- @if (!empty(getFeaturesSettings('show_facebook_login_button')))
                        <a href="{{url('/facebook/redirect')}}" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center ">
                            <img src="/assets/default/img/auth/facebook.svg" class="mr-auto" alt="facebook svg"/>
                            <span class="flex-grow-1">{{ trans('auth.facebook_login') }}</span>
                        </a>
                    @endif --}}

                {{-- <div class="mt-30 text-center">
                        <a href="/forget-password" target="_blank">{{ trans('auth.forget_your_password') }}</a>
                    </div> --}}

                <div class="mt-20 mb-15 text-center">
                    <span>{{ trans('auth.tidak_punya_akun') }}</span>
                    <a href="/register" class="text-secondary font-weight-bold font-14">{{ trans('auth.signup') }}</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('scripts_bottom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                var passwordInput = $('#form_password');
                var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                var icon = $('#passwordIcon');
                if (type === 'password') {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>
@endpush
