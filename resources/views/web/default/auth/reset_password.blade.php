@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/auth/style.css">
@endpush

@section('content')
    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="{{ getPageBackgroundSettings('remember_pass') }}" class="img-cover" alt="Login">
            </div>

            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">{{ trans('auth.reset_password') }}</h1>
                    <form method="post" action="/reset-password" class="mt-35">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="input-label" for="email">{{ trans('auth.email') }}:</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   value="{{ request()->get('email') }}" aria-describedby="emailHelp" disabled>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="input-label" for="password">{{ trans('auth.password') }}:</label>
                            <div class="position-styeles">
                                <input name="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" id="password"
                                       aria-describedby="passwordHelp">
                                <button type="button" class="btn-eye-reset_password" id="togglePassword">
                                    <i id="passwordIcon" class="fa fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="input-label" for="confirm_password">{{ trans('auth.retype_password') }}:</label>
                            <div class="position-styeles">
                                <input name="password_confirmation" type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password"
                                       aria-describedby="confirmPasswordHelp">
                                <button type="button" class="btn-eye-reset_password" id="toggleConfirmPassword">
                                    <i id="passwordConfirmIcon" class="fa fa-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label class="input-label" for="confirm_password">{{ trans('auth.retype_password') }}:</label>
                            <input name="password_confirmation" type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password"
                                   aria-describedby="confirmPasswordHelp">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}

                        <input hidden name="token" placeholder="token" value="{{ $token }}">

                        <button type="submit" class="btn btn-primary btn-block mt-20">{{ trans('auth.reset_password') }}</button>
                    </form>
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
           $('#toggleConfirmPassword').on('click', function() {
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