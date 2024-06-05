@extends('admin.layouts.app')

@push('styles_top')
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($group) ?trans('/admin/main.edit'): trans('admin/main.new') }} {{ trans('admin/main.iklan_banner') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ getAdminPanelUrl() }}/categories">{{ trans('admin/main.iklan_banner') }}</a>
                </div>
                <div class="breadcrumb-item">{{!empty($group) ?trans('/admin/main.edit'): trans('admin/main.new') }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ getAdminPanelUrl() }}/ad-banners/{{ !empty($group) ? $group->id.'/update' : 'store' }}" method="Post">
                                {{ csrf_field() }}

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.title') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="title" value="{{ !empty($group) ? $group->title : old('title') }}" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('admin/main.image') }}<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager" data-input="image" data-preview="holder">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="image" id="image" value="{{ !empty($group) ? $group->image : old('image') }}" class="form-control @error('image')  is-invalid @enderror"/>
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text admin-file-view" data-input="image">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.url') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="url" value="{{ !empty($group) ? $group->url : old('url') }}" class="form-control @error('url')  is-invalid @enderror" placeholder="Contoh : https://aaipi.id/home"/>
                                    @error('url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group mt-15">
                                    <label class="input-label">{{ trans('public.target') }}</label>
                                    <input type="text" name="target" value="{{ !empty($group) ? $group->target : old('target') }}" class="form-control @error('target')  is-invalid @enderror mb-1" placeholder="{{ trans('public.target_placeholder') }}"/>
                                    <span class="mt-5 font-12">Ketik <b><i>_blank</i></b> untuk membuka tab baru</span>
                                    @error('target')
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
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>

    {{-- <script src="/assets/default/js/admin/categories.min.js"></script> --}}
@endpush
