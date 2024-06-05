@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/leaflet/leaflet.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/contacts.css">
@endpush


@section('content')
    <section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ $contactSettings['background'] }}" class="img-cover" alt="{{ $pageTitle ?? '' }}" />

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ trans('site.contact_us') }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('site.contact_us') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <section class="">
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-30 mt-md-50">
                                <div class="col-12 col-md-12">
                                    <h3 class="font-20 font-weight-bold text-dark-blue d-flex align-items-left">
                                        {{ trans('site.title_info') }}</h3>
                                    <p class="font-weight-500 text-gray font-14 mt-10">{{ trans('site.desc_info') }}</p>

                                    <div class="d-flex flex-wrap">
                                        
                                        <div class="d-flex flex-column">
                                            <div class="m-0 mt-15">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center justify-content-center p-0">
                                                        <div class="circle-bg-list">
                                                            <img src="{{ asset('assets/aaipi/img/lokasi.svg') }}" alt="Lokasi">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h3 class="font-16 font-weight-bold text-dark-blue">
                                                            {{ trans('site.lokasi') }}</h3>
                                                        @if (!empty($contactSettings['address']))
                                                            <p style="" class="font-weight-500 font-14 text-gray">
                                                                {!! nl2br($contactSettings['address']) !!}</p>
                                                        @else
                                                            <p class="font-weight-500 text-gray font-14">
                                                                {{ trans('site.not_defined') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-0 mt-15">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center justify-content-center p-0">
                                                        <div class="circle-bg-list">
                                                            <img src="{{ asset('assets/aaipi/img/telp_kontak.svg') }}" alt="IconTelpKontak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h3 class="font-16 font-weight-bold text-dark-blue">
                                                            {{ trans('site.kontak') }}</h3>
                                                        @if (!empty($contactSettings['phones']))
                                                            <p style="" class="font-weight-500 font-14 text-gray">
                                                                {!! nl2br($contactSettings['phones']) !!}</p>
                                                        @else
                                                            <p class="font-weight-500 text-gray font-14">
                                                                {{ trans('site.not_defined') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <div class="m-0 mt-15">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center justify-content-center p-0">
                                                        <div class="circle-bg-list">
                                                            <img src="{{ asset('assets/aaipi/img/email.svg') }}" alt="IconEmail">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h3 class="font-16 font-weight-bold text-dark-blue">
                                                            {{ trans('site.email') }}</h3>
                                                        @if (!empty($contactSettings['emails']))
                                                            <p style="" class="font-weight-500 font-14 text-gray">
                                                                {!! nl2br($contactSettings['emails']) !!}</p>
                                                        @else
                                                            <p class="font-weight-500 text-gray font-14">
                                                                {{ trans('site.not_defined') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-0 mt-15">
                                                <div class="d-flex">
                                                    <div class="d-flex align-items-center justify-content-center p-0">
                                                        <div class="circle-bg-list">
                                                            <img src="{{ asset('assets/aaipi/img/jam.svg') }}" alt="IconJam">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h3 class="font-16 font-weight-bold text-dark-blue">
                                                            {{ trans('site.operasi_berjam_jam') }}</h3>
                                                        @if (!empty($contactSettings['operations']))
                                                            <p style="" class="font-weight-500 font-14 text-gray">
                                                                {!! nl2br($contactSettings['operations']) !!}</p>
                                                        @else
                                                            <p class="font-weight-500 text-gray font-14">
                                                                {{ trans('site.not_defined') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            @if (!auth()->check())
                <div class="col-12 col-md-6">
                    <section class="mt-30 mt-md-50 bg-form-contact rounded-ly py-35 px-25">
                        <h2 class="font-20 font-weight-bold text-secondary">{{ trans('site.siap_memulai') }}</h2>

                        @if (!empty(session()->has('msg')))
                            <div class="alert alert-success my-25 d-flex align-items-center">
                                <i data-feather="check-square" width="50" height="50" class="mr-2"></i>
                                {{ session()->get('msg') }}
                            </div>
                        @endif

                        <form id="myForm" action="{{ url('/contact/store') }}" method="post" class="mt-20">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name')  is-invalid @enderror"
                                            placeholder="{{ trans('site.nama_lengkap') }}" />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email')  is-invalid @enderror"
                                            placeholder="{{ trans('site.alamat_email') }}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control @error('phone')  is-invalid @enderror"
                                            placeholder="{{ trans('site.no_telp') }}" />
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control @error('subject')  is-invalid @enderror" placeholder="{{ trans('site.subject') }}" />
                                        @error('subject')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="message" id="" rows="10" class="form-control @error('message')  is-invalid @enderror"
                                            placeholder="{{ trans('site.menulis_pesan') }}">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group d-flex flex-column">
                                        <div class="form-check">
                                            <input type="checkbox" name="termsconditions" id="termsconditions" class="form-check-input @error('termsconditions') is-invalid @enderror" value="1">
                                            <label class="form-check-label input-label font-weight-500" for="termsconditions">
                                                <span class="text-dark">
                                                    Terima 
                                                </span> 
                                                <a href="/contact/terms-conditions" class="text-dark border-bottom border-dark" target="_BLANK">{{ trans('site.terms_and_conditions') }}</a>
                                            </label>
                                        </div>
                                        @error('termsconditions')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5">{{ trans('site.send_message') }}</button>
                        </form>
                    </section>
                </div>
            @endif
        </div>

        {{-- <section class="">
            @if (!empty($contactSettings['latitude']) and !empty($contactSettings['longitude']))
                <div class="contact-map" id="contactMap"
                     data-latitude="{{ $contactSettings['latitude'] }}"
                     data-longitude="{{ $contactSettings['longitude'] }}"
                     data-zoom="{{ $contactSettings['map_zoom'] ?? 12 }}"
                ></div>
            @endif
        </section> --}}

    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/vendors/leaflet/leaflet.min.js"></script>
    <script>
        var leafletApiPath = '{{ getLeafletApiPath() }}';
    </script>
    <script src="/assets/default/js/parts/contact.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(event) {
                // Check if the email field is empty or doesn't contain '@'
                if ($('#email').val() === '' || !$('#email').val().includes('@')) {
                    $('#emailError').show(); // Show the error message
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
@endpush
