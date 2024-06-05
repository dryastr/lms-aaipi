@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <style>
        .site-top-banner-custom{
            height: 230px!important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush

@section('content')
<!-- Halaman Beranda -->
<section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-12 col-md-9 col-lg-7">
                <div class="top-search-categories-form">
                    <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.account_verification') }}</h1>
                    <div class="d-flex align-items-center justify-content-center mt-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item font-12  text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.account_verification') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <div class="container" >
        <div class="row login-container justify-content-center">
            {{-- <div class="col-12 col-md-6 pl-0">
                <img src="{{ getPageBackgroundSettings('verification') }}" class="img-cover" alt="Login">
            </div> --}}

            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-22 font-weight-bold text-center">{{ trans('auth.account_verification') }}</h1>

                    <form method="post" action="/verification" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="username" value="{{ $usernameValue }}">

                        <div class="form-group">
                            <label class="input-label" for="{{ $username }}">{{ ucfirst(trans('auth.verification_' . $username)) }}</label>
                            <input type="text" name="{{ $username }}" class="form-control @error($username) is-invalid @enderror" id="{{ $username }}"
                                   aria-describedby="{{ $username }}Help" placeholder="{{ ucfirst(trans('auth.verification_' . $username)) }}" value="{{ $maskedEmail }}" disabled>
                            @error($username)
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="nip"></label>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip"
                                   aria-describedby="codeHelp" placeholder="{{ trans('auth.verification_nip') }}">
                            @error('nip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label" for="code"></label>
                            <input type="number" name="code" class="form-control @error('code') is-invalid @enderror" id="code"
                                   aria-describedby="codeHelp" placeholder="{{ trans('auth.verification_code_has_been_sent_to_your_email') }}">
                                    <span class="font-12 text-secondary ml-1">
                                        <i>*Jika anda tidak menerima email, harap cek kotak spam</i>
                                    </span>
                            @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.verification') }}</button>
                    </form>

                    <div class="text-center mt-20">
                        <span class="text-secondary">
                            <a href="/verification/resend" class="font-weight-bold">{{ trans('auth.resend_code') }}</a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
