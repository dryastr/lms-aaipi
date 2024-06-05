@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($group) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.thematic') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ getAdminPanelUrl() }}/categories">{{ trans('admin/main.thematic') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($group) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ getAdminPanelUrl() }}/tematik/{{ !empty($group) ? $group->id.'/update' : 'store' }}" method="Post">
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
                                <div class="form-group">
                                <label class="input-label font-12">{{ trans('admin/main.parent_thematic') }}<span class="text-danger">*</span></label>
                                <select name="parent_id" class="form-control @error('parent_id')  is-invalid @enderror" >
                                    <option value="" disabled selected>{{ trans('admin/main.select_option') }}</option>
                                    @foreach($nullParentData as $item)
                                        <option value="{{ $item->id }}" @if(!empty($group) && $group->parent_id == $item->id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.name') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ !empty($group) ? $group->name : old('name') }}" class="form-control @error('name')  is-invalid @enderror" placeholder=""/>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>                                

                                <div id="subCategories" class="ml-0 {{ (!empty($subCategories) and !$subCategories->isEmpty()) ? '' : ' d-none' }}">
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <strong class="d-block">{{ trans('admin/main.add_sub_categories') }}</strong>

                                        <button type="button" class="btn btn-success add-btn"><i class="fa fa-plus"></i> {{ trans('admin/main.add_new') }}</button>
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
