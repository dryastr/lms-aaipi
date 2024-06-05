<div class="row">
    <div class="col-12">
        <div class="form-group">
            <div style="position: relative;">
                <input name="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" 
                placeholder="{{ trans('auth.register_handphone') }}" 
                value="{{ old('mobile') }}" id="mobile" aria-describedby="mobileHelp" maxlength="13"
                style="padding-left: 45px;" pattern="[0-9]*">
                <button type="button"  class="btn-mobile-register"  disabled>+62</button>
            </div>
            @error('mobile')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>
