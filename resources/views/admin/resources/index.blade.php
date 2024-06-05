@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/admin/css/custom.css">
    <link rel="stylesheet" href="/assets/aaipi/css/admin/resources.css">
    <link rel="stylesheet" href="/assets/aaipi/css/panel/style.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.resources') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.resources') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th class="text-left col-md-3" style="">{{ trans('admin/main.title') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.seo_title') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.description') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.cover') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.category_name') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.file') }}</th>
                                        <th class="text-left" style="width: 10%;">{{ trans('admin/main.status') }}</th>
                                        <th style="width: 5%;">{{ trans('admin/main.action') }}</th>
                                    </tr>
                                    @if($resources->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">{{ trans('admin/main.no_data_available') }}</td>
                                        </tr>
                                    @else
                                    @foreach($resources as $resource)
                                    <tr class="">
                                        <td class="text-left">{{ str_replace('-', ' ', $resource->title) }}</td>
                                        <td class="text-left">{{ $resource->seotitle }}</td>
                                        <td class="text-left">{{ Str::limit($resource->description, 50) }}</td>
                                        <td class="text-left">
                                            <div class="img-resource">
                                                <img class="img-cover p-10" src="{{ $resource->cover }}" alt="{{ $resource->cover }}">
                                            </div>
                                        </td>
                                        {{-- <td class="text-left">{{ $resource->category->title }}</td> --}}
                                        <td class="text-left">{{ optional($resource->category)->title }}</td>
                                        <td class="text-left">{{ $resource->filename }}</td>
                                        <td>
                                            @switch($resource->status)
                                                @case(\App\Models\Resources::$active)
                                                    <div class="text-success font-600-bold">{{ trans('admin/main.published') }}</div>
                                                    @break
                                                @case(\App\Models\Resources::$isDraft)
                                                    <span class="text-dark">{{ trans('admin/main.is_draft') }}</span>
                                                    @break
                                                @case(\App\Models\Resources::$pending)
                                                    <span class="text-warning">{{ trans('admin/main.waiting') }}</span>
                                                    @break
                                                @case(\App\Models\Resources::$inactive)
                                                    <span class="text-danger">{{ trans('public.rejected') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td width="200" class="">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle outline-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu text-left webinars-lists-dropdown">
    
                                                    @can('admin_resources_edit')
                                                        @if($resource->status == \App\Models\Resources::$pending)
                                                            @include('admin.includes.delete_button',[
                                                                'url' => getAdminPanelUrl().'/resources/'.$resource->id.'/approve',
                                                                'btnClass' => 'd-flex align-items-center text-success text-decoration-none btn-transparent btn-sm mt-1',
                                                                'btnText' => '<i class="fa fa-check"></i><span class="ml-2">'. trans("admin/main.approve") .'</span>'
                                                                ])
    
                                                            @include('admin.includes.delete_button',[
                                                                'url' => getAdminPanelUrl().'/resources/'.$resource->id.'/reject',
                                                                'btnClass' => 'd-flex align-items-center text-danger text-decoration-none btn-transparent btn-sm mt-1',
                                                                'btnText' => '<i class="fa fa-times"></i><span class="ml-2">'. trans("admin/main.reject") .'</span>'
                                                                ])
                                                        @elseif($resource->status == \App\Models\Resources::$active)
                                                            @include('admin.includes.delete_button',[
                                                                'url' => getAdminPanelUrl().'/resources/'.$resource->id.'/unpublish',
                                                                'btnClass' => 'd-flex align-items-center text-danger text-decoration-none btn-transparent btn-sm mt-1',
                                                                'btnText' => '<i class="fa fa-times"></i><span class="ml-2">'. trans("admin/main.unpublish") .'</span>'
                                                                ])
                                                        @endif
                                                    @endcan

                                                    @can('admin_resources_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/resources/{{ $resource->id }}/sendNotification" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-bell"></i>
                                                            <span class="ml-2">{{ trans('notification.send_notification') }}</span>
                                                        </a>
                                                    @endcan
    
                                                    @can('admin_resources_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/resources/{{ $resource->id }}/edit" target="_blank" class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 " title="{{ trans('admin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                            <span class="ml-2">{{ trans('admin/main.edit') }}</span>
                                                        </a>
                                                    @endcan
    
                                                    @can('admin_resources_delete')
                                                        @include('admin.includes.delete_button',[
                                                                'url' => getAdminPanelUrl().'/resources/'.$resource->id.'/delete',
                                                                'btnClass' => 'd-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm mt-1',
                                                                'btnText' => '<i class="fa fa-times"></i><span class="ml-2">'. trans("admin/main.delete") .'</span>'
                                                                ])
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- PAGINATE --}}
                    <div class="card-footer text-center">
                        {{ $resources->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection