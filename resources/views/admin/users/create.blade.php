@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{!empty($user) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.user') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a
                    href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
            </div>
            <div class="breadcrumb-item"><a>{{ trans('admin/main.users') }}</a>
            </div>
            <div class="breadcrumb-item">{{!empty($user) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ getAdminPanelUrl() }}/users/store" method="Post">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label>{{ trans('/admin/main.full_name') }}<span class="text-danger">*</span></label>
                                        <input type="text" name="full_name"
                                            class="form-control  @error('full_name') is-invalid @enderror"
                                            value="{{ old('full_name') }}"
                                            placeholder="{{ trans('admin/main.create_field_full_name_placeholder') }}" maxlength="75" />
                                        @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="username">{{ trans('auth.email_or_mobile') }}<span class="text-danger">*</span></label>
                                        <input name="username" type="text"
                                            class="form-control @error('email') is-invalid @enderror @error('mobile') is-invalid @enderror"
                                            id="username" value="{{ old('email') }}" aria-describedby="emailHelp">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @error('mobile')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label">{{ trans('admin/main.password') }}<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend w-100">
                                                <span type="button" class="input-group-text">
                                                    <i class="fa fa-lock"></i>
                                                </span>
                                                <input type="password" name="password" id="password"
                                                class="form-control @error('password')  is-invalid @enderror"
                                                value="{{ old('password') }}" onkeyup="checkPasswordStrength()" maxlength="20" style="border-radius: 0px 5px 5px 0px"/>
                                                <div class="position-styeles">
                                                    <button type="button" class="btn-eye-password-register" id="togglePassword" style="">
                                                        <i id="passwordIcon" class="fa fa-eye @error('password') text-danger @enderror"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="password-strength-container"></div>
                                        @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{{ trans('/admin/main.role_name') }}<span class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('role_id') is-invalid @enderror" id="roleId" name="role_id">
                                            <option disabled selected>{{ trans('admin/main.select_role') }}</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id || isset($selectedRoleId) && $selectedRoleId == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }} - {{ $role->caption }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>{{ trans('/admin/main.provinsi') }}<span class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('province_code') is-invalid @enderror"
                                            id="province_code" name="province_code">
                                            <option disabled selected>{{ trans('admin/main.select_provinsi') }}</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->province_code }}" data-province="{{ $province->province_code }}" {{ old('province_code') == $province->province_code || isset($selectProvinceCode) && $selectProvinceCode == $province->province_code ? 'selected' : '' }}>
                                                    {{ $province->propinsi_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('province_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>{{ trans('/admin/main.kota_kabupaten') }}<span class="text-danger">*</span></label>
                                        <select class="form-control select2 @error('city_code') is-invalid @enderror"
                                            id="city_code" name="city_code" disabled>
                                            <option disabled selected>{{ trans('admin/main.select_kabupaten_kota') }}</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->city_code }}" data-province="{{ $city->province_code }}" {{ old('city_code') == $city->city_code || isset($selectCityCode) && $selectCityCode == $city->city_code ? 'selected' : '' }}>
                                                    {{ $city->kabupaten_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group" id="groupSelect">
                                        <label class="input-label d-block">{{ trans('admin/main.group') }}(Opsional)</label>
                                        <select name="group_id"
                                            class="form-control select2 @error('group_id') is-invalid @enderror">
                                            <option value="" selected disabled></option>

                                            @foreach($userGroups as $userGroup)
                                            <option value="{{ $userGroup->id }}" @if(!empty($notification) and
                                                !empty($notification->group) and $notification->group->id ==
                                                $userGroup->id) selected @endif  {{ old('group_id') == $userGroup->id ? 'selected' : '' }}>{{ $userGroup->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">@error('group_id') {{ $message }} @enderror</div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ trans('/admin/main.status') }}<span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option disabled selected>{{ trans('admin/main.select_status') }}</option>
                                            @foreach (\App\User::$statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status') === $status ? 'selected' :''}}>{{  $status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="text-left mt-4">
                                        <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts_bottom')

@endpush

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<script>
    $(document).ready(function(){
        $('#province_code').change(function(){
            var provinceCode = $(this).val();
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
                            $('#city_code').append('<option value="'+ value.city_code +'">'+ value.kabupaten_name +'</option>');
                        });
                        $('#city_code').prop('disabled', false);
                    }
                });
            }else{
                $('#city_code').empty();
                $('#city_code').prop('disabled', true);
            }
        });
    });
</script>