@extends('admin.layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.kabupaten') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.kabupaten') }}</div>
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
                                        <th class="text-left">{{ trans('admin/main.id') }}</th>
                                        <th>{{ trans('admin/main.kabupaten') }}</th>
                                        <th>{{ trans('public.code') }}</th>
                                        <th>{{ trans('admin/main.actions') }}</th>
                                    </tr>
                                    @foreach($city as $group)
                                    <tr>
                                        <td class="text-left">
                                            <span>{{ $group->id }}</span>
                                        </td>
                                        <td>{{ $group->kabupaten_name }}</td>                                     
                                        <td>{{ $group->city_code }}</td>                                     
                                        <td>
                                            @can('admin_group_edit')
                                                <a href="{{ getAdminPanelUrl() }}/kabupaten/{{ $group->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                
                                            @can('admin_group_delete')
                                                @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/kabupaten/'.$group->id.'/delete', 'deleteConfirmMsg' => trans('update.kabupaten_delete_confirm_msg')])
                                            @endcan
                                        </td> 
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                            <div class="card-footer text-center">
                                {{ $city->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
