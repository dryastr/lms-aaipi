@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <style>
        .site-top-banner-custom{
            height: 230px!important;
        }
    </style>
@endpush

@section('content')
    @php
        $get404ErrorPageSettings = get404ErrorPageSettings();
    @endphp
  <section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
    <img src="{{ getPageBackgroundSettings('login') }}" class="img-cover" alt="Login">
     <div class="container h-100">
         <div class="row h-100 align-items-center justify-content-center text-center">
             <div class="col-12 col-md-9 col-lg-7">
                 <div class="top-search-categories-form">
                     <h1 class="text-dark-blue font-30 mb-15">{{ trans('auth.halaman_404') }}</h1>
                     <div class="d-flex align-items-center justify-content-center mt-5">
                         <nav aria-label="breadcrumb">
                             <ol class="breadcrumb p-0 m-0">
                                 <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                 <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.halaman_404') }}</li>
                             </ol>
                         </nav>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

    <section class="my-50  container text-center">
        <h2 class="mt-25 font-36">{{ $get404ErrorPageSettings['error_title'] ?? '' }}</h2>
        <p class="mt-25 font-16">{{ $get404ErrorPageSettings['error_description'] ?? '' }}</p>
        <div class="row justify-content-md-center">
            <div class="col mt-25 col-md-6">
                <img src="{{ $get404ErrorPageSettings['error_image'] ?? '' }}" class="img-cover " alt="">
              
            </div>
        </div>
        <button class="btn btn-primary mt-50 rounded-pill "><a class="text-white" href="/">
            {{ trans('auth.pergi_ke_beranda') }}</a>
        </button>
    </section>
@endsection
