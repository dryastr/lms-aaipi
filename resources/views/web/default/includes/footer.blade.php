@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/cart.css">
@endpush

@php
    $socials = getSocials();
    if (!empty($socials) and count($socials)) {
        $socials = collect($socials)->sortBy('order')->toArray();
    }
    $member = getMemberUrl();
    $footerColumns = getFooterColumns();
     $contactSettings = getContactPageSettings();
@endphp

<footer class="footer bg-primary-footer position-relative user-select-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-subscribe">
                    <span class="font-weight-1500 font-24 d-flex justify-content-center mt-5 text-center text-white">{{ trans('footer.subscribe_content') }}</span>
                    <div class="col-12 col-md-12 btn btn-group-subscribe d-sm-flex justify-content-center mt-50 text-white">
                        @if (!empty($member['url_member_area']))
                        <a href="{{  $member['url_member_area'] }}" class="btn-subscribe mr-5 flex-fill">
                            {{ trans('footer.aktif_keanggotaan') }}
                        </a>
                        <a href="{{  $member['url_member_area']  }}" class="btn-subscribe ml-5 flex-fill">
                            {{ trans('footer.keanggotaan_luar_biasa') }}
                        </a>
                        @else
                        <a href="admin " class="btn-subscribe mr-5 flex-fill">
                            {{ trans('footer.aktif_keanggotaan') }}
                        </a>
                        <a href="admin" class="btn-subscribe ml-5 flex-fill">
                            {{ trans('footer.keanggotaan_luar_biasa') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @php
        //
        $columns = ['first_column','second_column','third_column', 'four_column'];
        // ,'forth_column'
    @endphp

    

    <div class="container">
        <div class="row">

            <div class="col-12 col-md-3 text-white mt-30 ">
                <div class="footer-logo">
                    <a href="/">
                        @if(!empty($generalSettings['footer_logo']))
                            <img src="{{ $generalSettings['footer_logo'] }}" class="img-cover" alt="footer logo">
                        @endif
                    </a>
                </div>
                
                {{-- <p class="font-weight-500 text-white font-14 mt-30">{{ trans('footer.footer_desc') }}</p> --}}
                <p class="font-weight-500 text-white font-14 mt-30">
                    @if(!empty($footerColumns[$column="first_column"]))
    
                    @if(!empty($footerColumns[$column]['value']))
                        <div class="mt-20">
                            {!! $footerColumns[$column]['value'] !!}
                        </div>
                    @endif
                @endif
                </p>
            </div>
            

            <div class="col-12 col-md-3 text-white mt-30">
                <h3 class="font-20 font-weight-bold text-white d-flex align-items-left">
                    {{ trans('footer.footer_berhubungan_title') }}</h3>

                <div class="d-flex flex-wrap">
                    
                    <div class="m-0 mt-20 flex-fill">
                        <div class="d-flex">
                            <div class="d-flex align-items-center justify-content-center p-0">
                                <div class="">
                                    <img src="{{ asset('assets/aaipi/img/footer/location.svg') }}" alt="Lokasi">
                                </div>
                            </div>  
                            <div class="col-md-10">
                                {!! nl2br(getContactPageSettings('address')) !!}
                                {{-- <p class="font-weight-500 text-gray font-14 mt-10">{!! nl2br(str_replace(',','<br/>',$contactSettings['emails'])) !!}</p> --}}
                                {{-- <p style="" class="font-weight-500 font-14 text-white">  {{ $generalSettings['site_address'] }} </p> --}}
                            </div>
                        </div>
                        
                    </div>

                    <div class="m-0 mt-20 flex-fill">
                        <div class="d-flex">
                            <div class="d-flex align-items-center justify-content-center p-0">
                                <div class="">
                                    <img src="{{ asset('assets/aaipi/img/footer/sms.svg') }}" alt="IconTelpKontak">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <p style="" class="font-weight-500 font-14 text-white">  {{ $generalSettings['site_email'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="m-0 mt-20 flex-fill">
                        <div class="d-flex">
                            <div class="d-flex align-items-center justify-content-center p-0">
                                <div class="">
                                    <img src="{{ asset('assets/aaipi/img/footer/messages.svg') }}" alt="IconEmail">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <p style="" class="font-weight-500 font-14 text-white"> {{ $generalSettings['site_phone'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-12 col-md-3 text-white mt-30">
                <h3 class="font-20 font-weight-bold text-white d-flex align-items-left">
                    {{ trans('footer.footer_jelajahi_tautan_title') }}</h3>
                    @if(!empty($footerColumns[$column="second_column"]))
    
                        @if(!empty($footerColumns[$column]['value']))
                            <div class="mt-20">
                                {!! $footerColumns[$column]['value'] !!}
                            </div>
                        @endif
                    @endif
            </div>

            <div class="col-12 col-md-3 text-white mt-30">
                <h3 class="font-20 font-weight-bold text-white d-flex align-items-left">
                    {{ trans('footer.footer_waktu_title') }}</h3>
                <p class="font-weight-500 text-white font-14 mt-20">  {!! nl2br(getContactPageSettings('time_open')) !!}</p>
                <p class="font-weight-500 text-white font-14 mt-20">{!! nl2br(getContactPageSettings('time_close')) !!}</p>
                

                <div class="d-flex footer-social footer-social-colors mt-30">
                    @if(!empty($socials) and count($socials))
                        @foreach($socials as $social)
                        <a href="{{ $social['link'] }}">
                            <img src="{{ $social['image'] }}" alt="{{ $social['title'] }}" class="mr-15 mt-15">
                        </a>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

        <div class="mt-40 border-blue py-25 d-flex align-items-center justify-content-between">
            @if(getOthersPersonalizationSettings('platform_phone_and_email_position') == 'footer')
                <div class="container d-flex align-items-center justify-content-between flex-wrap p-0">
                    <div class="d-flex flex-column">
                        <div class="d-flex font-14 text-white">{{ trans('update.platform_copyright_hint') }}</div>
                        <div class="d-flex font-14 text-white mt-5">
                            {{ trans('update.platform_powered_by_hint') }}
                            <a href="https://qeraton.com/" target="_blank" class="f-powered-content ml-1">
                                {{ trans('update.platform_qeraton_hint') }}
                            </a>
                        </div>

                    </div>

                    <div class="d-flex align-items-center justify-content-center f-contact-content">
                        <div class="d-flex align-items-center text-white font-14">
                            {{ $generalSettings['site_phone'] }}
                        </div>

                        <!-- Pembatas -->
                        <div class="border-left mx-5 mx-lg-15 h-100"></div>
            
                        <div class="d-flex align-items-center text-white font-14">
                            {{ $generalSettings['site_email'] }}
                        </div>
                    </div>
                    
                </div>
            @endif
        </div>
    </div>
</footer>
