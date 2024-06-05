@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ trans('admin/main.new_template') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
            </div>
            <div class="breadcrumb-item">{{ trans('admin/main.new_template') }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <p class="col-6 col-lg-3">{{ trans('quiz.student') }} : {{ $student ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('admin/main.course') }} : {{ $course ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('quiz.grade') }} : {{ $grade ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('admin/main.certificate_id') }} :
                        {{ $certificate_id ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('admin/main.date') }} : {{ $date ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('admin/main.instructor') }} :
                        {{ $instructor_name ?? '[]' }}</p>
                    <p class="col-6 col-lg-3">{{ trans('public.duration') }} : {{ $duration ?? '[]' }}</p>
                    <p class="col-6 col-lg-6">{{ trans('update.user_certificate_additional') }} :
                        {{ $user_certificate_additional ?? '[]' }}</p>
                </div>

                <hr class="my-4">

                <form method="post" action="" id="templateForm" class="form-horizontal form-bordered">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-6">
                            @if(!empty(getGeneralSettings('content_translate')))
                            <div class="form-group">
                                <label class="input-label">{{ trans('auth.language') }}</label>
                                <select name="locale"
                                    class="form-control {{ !empty($template) ? 'js-edit-content-locale' : '' }}">
                                    @foreach($userLanguages as $lang => $language)
                                    <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale',
                                        app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('locale')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @else
                            <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
                            @endif

                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('public.type') !!}<span class="text-danger">*</span></label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="">{{ trans('admin/main.select_type') }}</option>
                                    <option value="quiz"
                                        {{ (!empty($template) and $template->type == 'quiz') ? 'selected' : '' }}>
                                        {{ trans('update.quiz_related') }}</option>
                                    <option value="course"
                                        {{ (!empty($template) and $template->type == 'course') ? 'selected' : '' }}>
                                        {{ trans('update.course_completion') }}</option>
                                </select>
                                <div class="invalid-feedback">@error('type') {{ $message }} @enderror</div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('public.title') !!}<span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ !empty($template) ? $template->title : old('title') }}" placeholder="">
                                <div class="invalid-feedback">@error('title') {{ $message }} @enderror</div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">{{ trans('admin/main.template_image') }}<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text admin-file-manager "
                                            data-input="image" data-preview="holder">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="image" id="image"
                                        value="{{ !empty($template) ? $template->image : old('image') }}"
                                        class="js-certificate-image form-control @error('image') is-invalid @enderror" />
                                    <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                </div>
                                <div class="invalid-feedback">@error('image') {{ $message }} @enderror</div>
                                <div class="text-muted text-small mt-1">{{ trans('update.certificate_image_hint') }}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <dov class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('admin/main.position_x')
                                    !!}<span class="text-danger">*</span></label>
                                <input type="number" name="position_x"
                                    class="form-control @error('position_x') is-invalid @enderror"
                                    value="{{ !empty($template) ? $template->position_x : old('position_x') }}">
                                <div class="invalid-feedback">@error('position_x') {{ $message }} @enderror</div>
                            </div>
                        </dov>
                        <dov class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('admin/main.position_y')
                                    !!}<span class="text-danger">*</span></label>
                                <input type="number" name="position_y"
                                    class="form-control @error('position_y') is-invalid @enderror"
                                    value="{{ !empty($template) ? $template->position_y : old('position_y') }}">
                                <div class="invalid-feedback">@error('position_y') {{ $message }} @enderror</div>
                            </div>
                        </dov>

                        <dov class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('admin/main.font_size')
                                    !!}<span class="text-danger">*</span></label>
                                <input type="text" name="font_size"
                                    class="form-control @error('font_size') is-invalid @enderror"
                                    value="{{ !empty($template) ? $template->font_size : old('font_size') }}">
                                <div class="invalid-feedback">@error('font_size') {{ $message }} @enderror</div>
                            </div>
                        </dov>
                        <dov class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">{!! trans('admin/main.text_color')
                                    !!}<span class="text-danger">*</span></label>
                                <input type="text" name="text_color"
                                    class="form-control @error('text_color') is-invalid @enderror"
                                    value="{{ !empty($template) ? $template->text_color : old('text_color') }}" >
                                <div class="invalid-feedback">@error('text_color') {{ $message }} @enderror</div>
                                <div class="mt-1" style="font-size: 12px">Example: #e1e1e1</div>
                            </div>
                        </dov>
                    </div>

                    <div id="additionalForm" class="form-group custom-switches-stacked">
                        <label class="" for="is_komite">{{ trans('webinars.is_komite') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_komite" class="custom-control-input" id="is_komite" {{ !empty($template) && $template->is_komite ? 'checked' : ''  }}>
                            <label class="custom-control-label" for="is_komite"></label>
                        </div>
                    </div>

                    <div id="additionalTable" class="form-group mt-15">
                        <label class="input-label">Nama Ketua Komite</label>
                        <input type="text" name="name_komite" value="{{ !empty($template) ? $template->name_komite : old('name_komite') }}" class="form-control @error('name_komite')  is-invalid @enderror" placeholder=""/>
                        @error('name_komite')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div id="additionalTable2" class="form-group mt-15">
                        <label class="input-label"> Nip Ketua Komite</label>
                        <input type="number" name="nip_komite" value="{{ !empty($template) ? $template->nip_komite : old('nip_komite') }}" class="form-control @error('nip_komite')  is-invalid @enderror" placeholder=""/>
                        @error('nip_komite')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                          @enderror
                    </div>

                    <div id="additionalTable3"  class="form-group">
                        <label class="input-label">{{ trans('admin/main.template_image') }}<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text admin-file-manager "
                                    data-input="tanda_tangan_komite" data-preview="holder">
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            <input type="text" name="tanda_tangan_komite" id="tanda_tangan_komite"
                                value="{{ !empty($template) ? $template->tanda_tangan_komite : old('tanda_tangan_komite') }}"
                                class="js-certificate-tanda_tangan_komite form-control @error('tanda_tangan_komite') is-invalid @enderror" />
                            <div class="invalid-feedback">@error('tanda_tangan_komite') {{ $message }} @enderror</div>
                        </div>
                        <div class="invalid-feedback">@error('tanda_tangan_komite') {{ $message }} @enderror</div>
                        <div class="text-muted text-small mt-1">{{ trans('update.certificate_tanda_tangan_komite_hint') }}
                        </div>
                    </div>


                    <div class="form-group ">
                        <label class="control-label" for="inputDefault">{{ trans('admin/main.message_body') }}<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('body') is-invalid @enderror" rows="9"
                            name="body">{{ (!empty($template)) ? $template->body : old('body') }}</textarea>
                        <div class="invalid-feedback">@error('body') {{ $message }} @enderror</div>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="rtl" value="0">
                            <input type="checkbox" id="rtl" name="rtl" value="1"
                                {{ (!empty($template) and $template->rtl) ? 'checked="checked"' : '' }}
                                class="custom-switch-input" />
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer"
                                for="rtl">{{ trans('admin/main.rtl') }}</label>
                        </label>
                    </div>

                    <div class="form-group custom-switches-stacked">
                        <label class="custom-switch pl-0">
                            <input type="hidden" name="status" value="draft">
                            <input type="checkbox" id="status" name="status" value="publish"
                                {{ (!empty($template) and $template->status == 'publish') ? 'checked="checked"' : '' }}
                                class="custom-switch-input" />
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description mb-0 cursor-pointer"
                                for="status">{{ trans('admin/main.active') }}</label>
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="">
                            <button class="btn btn-primary pull-left" id="submiter" type="button"
                                data-action="{{ !empty($template) ? getAdminPanelUrl("/certificates/templates/{$template->id}/update") : getAdminPanelUrl("/certificates/templates/store") }}">{{ trans('public.save') }}</button>
                            <button class="btn btn-primary disabled pull-left" id="preview" type="button"
                                data-action="{{ getAdminPanelUrl() }}/certificates/templates/preview">{{ trans('admin/main.preview_certificate') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts_bottom')


<script src="/assets/default/js/admin/certificates.min.js"></script>

<script>
    // Wait for the document to be ready
    $(document).ready(function () {
        $("#additionalForm").show();
        $("#additionalTable").hide();
        $("#additionalTable2").hide();
        $("#additionalTable3").hide();

        $("#WebinarType").change(function () {
        if ($(this).val() == "webinar") {
            $("#additionalForm").slideDown();
        } else {
            $("#additionalForm").slideUp();
        }
    });
    $("#is_komite").change(function () {
        if ($(this).is(":checked")) {
            $("#additionalTable").slideDown();
            $("#additionalTable2").slideDown();
            $("#additionalTable3").slideDown();
        } else {
            $("#additionalTable").slideUp();
            $("#additionalTable2").slideUp();
            $("#additionalTable3").slideUp();
        }
    });
    });
</script>
@endpush
