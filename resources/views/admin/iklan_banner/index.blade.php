@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/admin/iklan-banner.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.type') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{ trans('admin/main.dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.type') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <thead>
                                        <tr>
                                            <th class="text-left">{{ trans('admin/main.title') }}</th>
                                            <th class="text-left">{{ trans('admin/main.image') }}</th>
                                            <th class="text-left">{{ trans('admin/main.url') }}</th>
                                            <th class="text-left">{{ trans('admin/main.target') }}</th>
                                            <th class="text-left">{{ trans('admin/main.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($iklanBanners as $iklanBanner)
                                            <tr class="">
                                                <td class="text-left">{{ $iklanBanner->title }}</td>
                                                <td class="text-left">
                                                    <div class="img-banner">
                                                        <img class="img-cover w-100" src="{{ $iklanBanner->image }}" alt="{{ $iklanBanner->title }}">
                                                    </div>
                                                </td>
                                                <td class="text-left">
                                                    {{ $iklanBanner->url }}
                                                </td>
                                                <td class="text-left">
                                                    @if($iklanBanner->target == '_blank')
                                                        <b>
                                                            <i>
                                                                {{ $iklanBanner->target }}
                                                            </i>
                                                        </b>
                                                    @else
                                                        <p class="text-danger">
                                                            <b><i>Default</i></b>
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    @can('admin_group_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/ad-banners/{{ $iklanBanner->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    
                                                    @can('admin_group_delete')
                                                        @include('admin.includes.delete_button', ['url' => getAdminPanelUrl().'/ad-banners/'.$iklanBanner->id.'/delete', 'deleteConfirmMsg' => trans('update.delete_confirm_msg')])
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">{{ trans('admin/main.no_data_available') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
