@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($group) ? trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.kabupaten') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ getAdminPanelUrl() }}/categories">{{ trans('admin/main.type') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($group) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
                            {{-- <form action="{{ getAdminPanelUrl() }}/categories/{{ !empty($category) ? $category->id.'/update' : 'store' }}" --}}
                            <form action="{{ getAdminPanelUrl() }}/kabupaten/{{ !empty($group) ? $group->id.'/update' : 'store' }}" method="Post">
                                {{ csrf_field() }}

                                @if(!empty(getGeneralSettings('content_translate')))
                                    <div class="form-group">
                                        <label class="input-label">{{ trans('auth.language') }}</label>
                                        <select name="locale" class="form-control {{ !empty($category) ? 'js-edit-content-locale' : '' }}">
                                            @foreach($userLanguages as $lang => $language)
                                                <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
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

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.nama_kabupaten') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="city_name" id="city_name" value="{{ !empty($group) ? $group->kabupaten_name : old('kabupaten_name') }}" class="form-control @error('city_name')  is-invalid @enderror" placeholder="" />
                                    @error('city_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label class="input-label font-12">{{ trans('public.provinsi') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="province_id" class="form-control @error('province_id')  is-invalid @enderror" >
                                    <option value=""></option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->mst_propinsi_id }}" @if(!empty($group) && $group->mst_propinsi_id == $province->mst_propinsi_id) selected @endif >{{ $province->propinsi_name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                                
                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.code') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="code" id="code" value="{{ !empty($group) ? $group->city_code : old('city_code') }}" class="form-control @error('code')  is-invalid @enderror" placeholder="" />
                                    @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.shape') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea type="text" name="shape" id="shape" value="" class="form-control @error('shape')  is-invalid @enderror" placeholder="" style="height: 300px"> {{ old('shape', !empty($group) ? $group->shape : '') }}</textarea>
                                    @error('shape')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
{{-- 
                                <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select class="form-control" id="province_id" name="province_id" required>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div id="subCategories" class="ml-0 {{ (!empty($subCategories) and !$subCategories->isEmpty()) ? '' : ' d-none' }}">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <strong class="d-block">{{ trans('admin/main.add_sub_categories') }}</strong>

                                        <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i> Add</button>
                                    </div>

                                    <ul class="draggable-lists list-group">

                                        @if((!empty($subCategories) and !$subCategories->isEmpty()))
                                            @foreach($subCategories as $key => $subCategory)
                                                <li class="form-group list-group">

                                                    <div class="p-2 border rounded-sm">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text cursor-pointer move-icon">
                                                                    <i class="fa fa-arrows-alt"></i>
                                                                </div>
                                                            </div>

                                                            <input type="text" name="sub_categories[{{ $subCategory->id }}][title]"
                                                                   class="form-control w-auto flex-grow-1"
                                                                   value="{{ $subCategory->title }}"
                                                                   placeholder="{{ trans('admin/main.choose_title') }}"/>

                                                            <div class="input-group-append">
                                                                @include('admin.includes.delete_button',[
                                                                         'url' => getAdminPanelUrl("/categories/{$subCategory->id}/delete"),
                                                                         'deleteConfirmMsg' => trans('update.category_delete_confirm_msg'),
                                                                         'btnClass' => 'btn btn-danger text-white',
                                                                         'noBtnTransparent' => true
                                                                     ])
                                                            </div>
                                                        </div>

                                                        <div class="input-group w-100 mt-1">
                                                            <input type="text" name="sub_categories[{{ $subCategory->id }}][slug]"
                                                                   class="form-control w-auto flex-grow-1"
                                                                   value="{{ $subCategory->slug }}"
                                                                   placeholder="{{ trans('admin/main.choose_url') }}"/>
                                                        </div>

                                                        <div class="input-group mt-1">
                                                            <div class="input-group-prepend">
                                                                <button type="button" class="input-group-text admin-file-manager " data-input="icon_{{ $subCategory->id }}" data-preview="holder">
                                                                    <i class="fa fa-upload"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="sub_categories[{{ $subCategory->id }}][icon]" id="icon_{{ $subCategory->id }}" class="form-control" value="{{ $subCategory->icon }}" placeholder="{{ trans('admin/main.icon') }}"/>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                                </div>
                                
                            </form>

                            <li class="form-group main-row list-group d-none">
                                <div class="p-2 border rounded-sm">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text cursor-pointer move-icon">
                                                <i class="fa fa-arrows-alt"></i>
                                            </div>
                                        </div>

                                        <input type="text" name="sub_categories[record][title]"
                                               class="form-control w-auto flex-grow-1"
                                               placeholder="{{ trans('admin/main.choose_title') }}"/>

                                        <div class="input-group-append">
                                            <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>

                                    <div class="input-group mt-1">
                                        <input type="text" name="sub_categories[record][slug]"
                                               class="form-control w-auto flex-grow-1"
                                               placeholder="{{ trans('admin/main.choose_url') }}"/>
                                    </div>

                                    <div class="input-group mt-1">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager " data-input="icon_record" data-preview="holder">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="sub_categories[record][icon]" id="icon_record" class="form-control" placeholder="{{ trans('admin/main.icon') }}"/>
                                    </div>
                                </div>
                            </li>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>

    <script src="/assets/default/js/admin/categories.min.js"></script>
@endpush
