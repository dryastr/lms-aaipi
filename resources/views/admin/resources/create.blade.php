@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/admin/css/custom.css">
    <link rel="stylesheet" href="/assets/aaipi/css/admin/resources.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($resource) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.resources') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ getAdminPanelUrl() }}/categories">{{ trans('admin/main.resources') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($resource) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ getAdminPanelUrl() }}/resources/{{ !empty($resource) ? $resource->id.'/update' : 'store' }}" enctype="multipart/form-data" id="webinarForm" class="webinar-form">
                                {{ csrf_field() }}
                                <section>
                                    <h2 class="section-title after-line">{{ trans('public.basic_information') }}</h2>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('public.title') }}<span class="text-danger">*</span></label>
                                                <input type="text" name="title" value="{{ !empty($resource) ? str_replace('-', ' ', $resource->title) : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.seo_title') }}<span class="text-danger">*</span></label>
                                                <input type="text" name="seotitle" value="{{ !empty($resource) ? $resource->seotitle : old('seotitle') }}" class="form-control @error('seotitle')  is-invalid @enderror" placeholder=""/>
                                                @error('seotitle')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.description') }}<span class="text-danger">*</span></label>
                                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ !empty($resource) ? $resource->description : old('description') }}</textarea>
                                                <div class="text-muted text-small mt-1">{{ trans('admin/main.seo_description_hint') }}</div>
                                                @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>                                            

                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.cover') }}<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="input-group-text admin-file-manager" data-input="cover" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="cover" id="cover" value="{{ !empty($resource) ? $resource->cover : old('cover') }}" class="form-control @error('cover')  is-invalid @enderror"/>
                                                    <div class="input-group-append">
                                                        <button type="button" class="input-group-text admin-file-view" data-input="cover">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('cover')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="mt-3">
                                    <h2 class="section-title after-line">{{ trans('public.additional_information') }}</h2>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('public.category') }}<span class="text-danger">*</span></label>
                                                <select id="categories" class="custom-select @error('category_id')  is-invalid @enderror" name="category_id" required>
                                                    <option {{ !empty($resource) ? '' : 'selected' }} disabled>{{ trans('public.choose_category') }}</option>
                                                    @foreach($categories as $category)
                                                        @if(!empty($category->subCategories) and count($category->subCategories))
                                                            <optgroup label="{{  $category->title }}">
                                                                @foreach($category->subCategories as $subCategory)
                                                                    <option value="{{ $subCategory->id }}" {{ (!empty($resource) and $resource->category_id == $subCategory->id) ? 'selected' : '' }}>{{ $subCategory->title }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @else
                                                            <option value="{{ $category->id }}" {{ (!empty($resource) and $resource->category_id == $category->id) ? 'selected' : '' }}>{{ $category->title }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group mt-15 {{ (!empty($ResourceCategoryFilters) && count($ResourceCategoryFilters)) ? '' : 'd-none' }}" id="categoriesFiltersContainer">
                                                <span class="input-label d-block">{{ trans('public.category_filters') }}<span class="text-danger">*</span></span>
                                                <div id="categoriesFiltersCard" class="row mt-3">
                                                    @if(!empty($ResourceCategoryFilters) && count($ResourceCategoryFilters))
                                                        @foreach($ResourceCategoryFilters as $filter)
                                                            <div class="col-12 col-md-3">
                                                                <div class="webinar-category-filters mb-15">
                                                                    <strong class="category-filter-title d-block">{{ $filter->translations[0]->title }}</strong>
                                                                    <div class="py-10"></div>
                                                                    @foreach($filter->options as $option)
                                                                        <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                                                                            <label class="" for="filterOption{{ $option->id }}">{{ $option->title }}</label>
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" name="filters[]" value="{{ $option->id }}" {{ ((!empty($ResourceFilterOptions) && in_array($option->id, $ResourceFilterOptions)) ? 'checked' : '') }} class="custom-control-input" id="filterOption{{ $option->id }}">
                                                                                <label class="custom-control-label" for="filterOption{{ $option->id }}"></label>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.type_other_category_id') }}<span class="text-danger">*</span></label>
                                            
                                                <select id="type_other_category_id" class="custom-select @error('type_other_category_id') is-invalid @enderror" name="type_other_category_id" required>
                                                    <option {{ !empty($resource) ? '' : 'selected' }} disabled>{{ trans('admin/main.choose_type') }}</option>
                                            
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id }}" {{ (!empty($resource) and $resource->type_other_category_id == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('type_other_category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>  
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.crosscom_tematik_other_category_id') }}<span class="text-danger">*</span></label>
                                            
                                                <select id="crosscom_tematik_other_category_id" class="custom-select @error('crosscom_tematik_other_category_id') is-invalid @enderror" name="crosscom_tematik_other_category_id" required>
                                                    <option {{ !empty($resource) ? '' : 'selected' }} disabled>{{ trans('admin/main.choose_crosscom_or_thematic') }}</option>
                                            
                                                    @foreach($crosscomsAndThematics as $category)
                                                        <option value="{{ $category->id }}" {{ (!empty($resource) and $resource->crosscom_tematik_other_category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            
                                                @error('crosscom_tematik_other_category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mt-15">
                                                <label class="input-label">{{ trans('admin/main.input_file') }}<span class="text-danger">*</span></label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control @error('source') is-invalid @enderror" value="{{ !empty($resource) ? $resource->source : old('source') }}" name="source" id="source" aria-describedby="sourceHelp" required>
                                                    <label class="d-flex align-items-center custom-file-label" for="source">
                                                        @if(!empty($resource) && !empty($resource->filename))
                                                            {{ $resource->filename }}
                                                        @else
                                                            {{ trans('admin/main.input_file_pdf') }}
                                                        @endif
                                                    </label>
                                                </div>                                              
                                                @error('source')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="forDraft" value="0" id="forDraft"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" id="saveAndPublish" class="btn btn-primary">
                                                {{ !empty($resource) ? trans('admin/main.save_and_publish') : trans('admin/main.save_and_continue') }}
                                            </button>
    
                                            @if(!empty($resource))
                                                <button type="submit" id="saveReject" class="btn btn-warning">
                                                    {{ ($resource->status == "active") ? trans('update.unpublish') : trans('public.reject') }}
                                                </button>
    
                                                @include('admin.includes.delete_button',[
                                                        'url' => getAdminPanelUrl().'/resources/'. $resource->id .'/delete',
                                                        'btnText' => trans('public.delete'),
                                                        'hideDefaultClass' => true,
                                                        'btnClass' => 'btn btn-danger',
                                                        'redirectUrl' => getAdminPanelUrl().'/resources'
                                                        ])
                                            @endif
                                        </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/aaipi/js/admin/resource.min.js"></script>
    {{-- <script src="/assets/default/js/panel/resource.min.js"></script> --}}
    <script>
        $('body').on('click', '#saveAndPublish', function (e) {
            e.preventDefault();
            $('#forDraft').val('publish'); 
            $('#webinarForm').submit(); 
        });

        $('body').on('click', '#saveAsDraft', function (e) {
            e.preventDefault();
            $('#forDraft').val(1);
            $('#webinarForm').submit();
        });

        $('body').on('click', '#saveReject', function (e) {
            e.preventDefault();
            $('#forDraft').val('reject'); 
            $('#webinarForm').submit(); 
        });
    </script>
@endpush