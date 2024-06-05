<div class="form-group">
    {{-- <label class="input-label" for="email">{{ trans('auth.email') }} {{ !empty($optional) ? "(". trans('public.optional') .")" : '' }}:</label> --}}
    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
    placeholder="{{ trans('auth.register_email') }}" value="{{ old('email') }}" id="email" aria-describedby="emailHelp" maxlength="40">

    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
