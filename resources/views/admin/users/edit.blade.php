@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('/admin/main.edit') }} {{ trans('admin/main.user') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}/users">{{ trans('admin/main.users') }}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('/admin/main.edit') }}</div>
            </div>
        </div>

        @if(!empty(session()->has('msg')))
            <div class="alert alert-success my-25">
                {{ session()->get('msg') }}
            </div>
        @endif


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if(empty($becomeInstructor)) active @endif" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">{{ trans('admin/main.main_general') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">{{ trans('auth.images') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="financial-tab" data-toggle="tab" href="#financial" role="tab" aria-controls="financial" aria-selected="true">{{ trans('admin/main.financial') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="occupations-tab" data-toggle="tab" href="#occupations" role="tab" aria-controls="occupations" aria-selected="true">{{ trans('site.occupations') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="true">{{ trans('admin/main.badges') }}</a>
                                </li>

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_registration_package')
                                        <li class="nav-item">
                                            <a class="nav-link" id="registrationPackage-tab" data-toggle="tab" href="#registrationPackage" role="tab" aria-controls="registrationPackage" aria-selected="true">{{ trans('update.registration_package') }}</a>
                                        </li>
                                    @endcan
                                @endif

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_meeting_settings')
                                        <li class="nav-item">
                                            <a class="nav-link" id="meetingSettings-tab" data-toggle="tab" href="#meetingSettings" role="tab" aria-controls="meetingSettings" aria-selected="true">{{ trans('update.meeting_settings') }}</a>
                                        </li>
                                    @endcan
                                @endif

                                @if(!empty($becomeInstructor))
                                    <li class="nav-item">
                                        <a class="nav-link @if(!empty($becomeInstructor)) active @endif" id="become_instructor-tab" data-toggle="tab" href="#become_instructor" role="tab" aria-controls="become_instructor" aria-selected="true">{{ trans('admin/main.become_instructor_info') }}</a>
                                    </li>
                                @endif


                                <li class="nav-item">
                                    <a class="nav-link" id="purchased_courses-tab" data-toggle="tab" href="#purchased_courses" role="tab" aria-controls="purchased_courses" aria-selected="true">{{ trans('update.purchased_courses') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="purchased_bundles-tab" data-toggle="tab" href="#purchased_bundles" role="tab" aria-controls="purchased_bundles" aria-selected="true">{{ trans('update.purchased_bundles') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="purchased_products-tab" data-toggle="tab" href="#purchased_products" role="tab" aria-controls="purchased_products" aria-selected="true">{{ trans('update.purchased_products') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="topics-tab" data-toggle="tab" href="#topics" role="tab" aria-controls="topics" aria-selected="true">{{ trans('update.forum_topics') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">

                                @include('admin.users.editTabs.general')

                                @include('admin.users.editTabs.images')

                                @include('admin.users.editTabs.financial')

                                @include('admin.users.editTabs.occupations')

                                @include('admin.users.editTabs.badges')

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_registration_package')
                                        @include('admin.users.editTabs.registration_package')
                                    @endcan
                                @endif

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_meeting_settings')
                                        @include('admin.users.editTabs.meeting_settings')
                                    @endcan
                                @endif

                                @if(!empty($becomeInstructor))
                                    @include('admin.users.editTabs.become_instructor')
                                @endif

                                @include('admin.users.editTabs.purchased_courses')

                                @include('admin.users.editTabs.purchased_bundles')

                                @include('admin.users.editTabs.purchased_products')

                                @include('admin.users.editTabs.topics')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script> --}}
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
    </script>
    <script>
        $(document).ready(function(){
            // Fungsi untuk mengatur opsi kabupaten/kota berdasarkan provinsi yang dipilih
            function filterCitiesByProvince(provinceCode) {
                // Simpan nilai default dari kabupaten/kota sebelum memfilter opsi kabupaten/kota
                var defaultCityCode = $('#city_code').val();

                if(provinceCode){
                    $.ajax({
                        url: '{{ route("get-cities-by-province") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            province_code: provinceCode
                        },
                        success: function(response) {
                            $('#city_code').empty();
                            $('#city_code').append('<option value="" disabled selected>{{ trans('admin/main.kabupaten') }}</option>');
                            $.each(response.cities, function(key, value) {
                                $('#city_code').append('<option value="'+ value.city_code +'">'+ value.alias +'</option>');
                            });

                            // Periksa apakah nilai default masih tersedia dalam opsi kabupaten/kota yang baru
                            if($('#city_code').find('option[value="' + defaultCityCode + '"]').length > 0) {
                                $('#city_code').val(defaultCityCode); // Gunakan nilai default jika masih tersedia
                            } else {
                                $('#city_code').prop('selectedIndex', 0); // Pilih opsi pertama sebagai nilai default
                            }
                            
                            $('#city_code').prop('disabled', false);
                        }
                    });
                }else{
                    $('#city_code').empty();
                    $('#city_code').prop('disabled', true);
                }
            }

            // Panggil fungsi filterCitiesByProvince saat halaman dimuat untuk memfilter kabupaten/kota berdasarkan provinsi awal
            filterCitiesByProvince($('#province_name').val());

            // Tambahkan event listener untuk mengubah provinsi
            $('#province_name').change(function(){
                var provinceCode = $(this).val();
                filterCitiesByProvince(provinceCode); // Panggil fungsi filterCitiesByProvince saat provinsi berubah
            });
        });
    </script>
@endpush
