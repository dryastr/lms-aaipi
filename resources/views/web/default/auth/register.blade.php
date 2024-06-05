@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/auth/style.css">
@endpush

@section('content')
@php
    $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
    $showOtherRegisterMethod = getFeaturesSettings('show_other_register_method') ?? false;
    $showCertificateAdditionalInRegister = getFeaturesSettings('show_certificate_additional_in_register') ?? false;
    $selectRolesDuringRegistration = getFeaturesSettings('select_the_role_during_registration') ?? null;
@endphp

<section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-12 col-md-9 col-lg-7">
                <div class="top-search-categories-form">
                    <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.register') }}</h1>
                    <div class="d-flex align-items-center justify-content-center mt-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.register') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row ">
        <div class="mt-md-50 col-md-5 ">
            <h1 class="font-21 text-center font-weight-bold">{{ trans('auth.signup_h1') }}</h1>
            <p class="text-center form-title">{{ trans('auth.signup_p') }}</p>
            <form method="post" action="/register" class="mt-35" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="is_member_aaipi" value="0">

                <div class="form-group">
                    <input name="full_name" type="text" value="{{ old('full_name') }}"  placeholder="{{ trans('auth.register_nama') }}" class="form-control @error('full_name') is-invalid @enderror" maxlength="50">
                    @error('full_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @if($registerMethod == 'mobile')
                @include('web.default.auth.register_includes.mobile_field')

                @if($showOtherRegisterMethod)
                    @include('web.default.auth.register_includes.email_field',['optional' => true])
                @endif
                @else
                    @include('web.default.auth.register_includes.email_field')

                    @if($showOtherRegisterMethod)
                        @include('web.default.auth.register_includes.mobile_field',['optional' => true])
                    @endif
                @endif
                

                <div class="form-group">
                    <div class="position-styeles">
                        <input name="password" type="password" value="{{ old('password') }}"  class="form-control @error('password') is-invalid @enderror" id="password" placeholder="{{ trans('auth.register_katasandi') }}" aria-describedby="passwordHelp" oninput="checkPasswordStrength()" maxlength="25">
                        <button type="button" class="btn-eye-password-register" id="togglePassword" style="">
                            <i id="passwordIcon" class="fa fa-eye @error('password') text-danger @enderror"></i>
                        </button>
                    </div>
                    <div id="password-strength-container" style="margin-top: 5px;"></div>
                    @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group ">
                    <div class="position-styeles">
                        <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password" aria-describedby="confirmPasswordHelp"  placeholder="{{ trans('auth.register_katasandi_ulang') }}" maxlength="25">
                        <button type="button" class="btn-eye-password-register" id="toggleConfirmChangePassword">
                            <i id='passwordConfirmIcon' class="fa fa-eye @error('password_confirmation') text-danger @enderror"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                @if(!empty($referralSettings) and $referralSettings['status'])
                <div class="form-group ">
                    <input name="referral_code" type="text" class="form-control @error('referral_code') is-invalid @enderror" id="referral_code" value="{{ !empty($referralCode) ? $referralCode : old('referral_code') }}" aria-describedby="confirmPasswordHelp">
                    @error('referral_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @endif

                @if(!empty(getGeneralSecuritySettings('captcha_for_register')))
                @include('web.default.includes.captcha_input')
                @endif

                <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.signup') }}</button>
                <div class="mt-30 text-center sudah_punya_akun">
                    <span>{{ trans('auth.sudah_punya_akun') }}</span>
                    <a href="/login" class="text-secondary font-weight-bold font-14 link_sudah_punya_akun">{{ trans('auth.login') }}</a>
                </div>
            </form>
        </div>

        <div class="col-md-5 daftar">
            <img src="{{ getPageBackgroundSettings('register') }}" class="img-cover" alt="Login">
        </div>
    </div>
</div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <script>
        function checkPasswordStrength() {
            var password = document.getElementById("password").value;
            var strengthContainer = document.getElementById("password-strength-container");
            var lowerCaseLetters = /[a-z]/g; 
            var upperCaseLetters = /[A-Z]/g;
            var numbers = /[0-9]/g;

            var strength = 0;

        
            if (password.length >= 6) {
                strength += 1;
            }

        
            if (password.match(lowerCaseLetters)) {
                strength += 1;
            }

            
            if (password.match(upperCaseLetters)) {
                strength += 1;
            }
            
            if (password.match(numbers)) {
                strength += 1;
            }

            switch (strength) {
                case 0:
                    strengthContainer.innerHTML = "";
                    break;
                case 1:
                    strengthContainer.innerHTML = "<span style='color: red; font-size: 12px'>{{ trans('auth.low_sandi') }}</span>";
                    break;
                case 2:
                    strengthContainer.innerHTML = "<span style='color: orange;  font-size: 12px'>{{ trans('auth.medium_sandi') }}</span>";
                    break;
                case 3:
                case 4:
                    strengthContainer.innerHTML = "<span style='color: green;  font-size: 12px'>{{ trans('auth.password_high') }}</span>";
                    break;
            }
        }

        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                var passwordInput = $('#password');
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

        $(document).ready(function() {
            $('#toggleConfirmChangePassword').on('click', function() {
                console.log('sasa');
                var passwordInput = $('#confirm_password');
                var type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                var icon = $('#passwordConfirmIcon');
                if (type === 'password') {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        }); 
    </script>
@endpush
