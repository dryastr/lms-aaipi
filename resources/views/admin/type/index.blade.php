@extends('admin.layouts.app')

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
                                            <th class="text-left">{{ trans('admin/main.name') }}</th>
                                            <th>{{ trans('admin/main.type') }}</th>
                                            <th>{{ trans('admin/main.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($types as $type)
                                            <tr>
                                                <td class="text-left">{{ $type->name }}</td>
                                                <td>{{ $type->types }}</td>
                                                <td>
                                                    @can('admin_group_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/type/{{ $type->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    
                                                    @can('admin_group_delete')
                                                        @include('admin.includes.delete_button', ['url' => getAdminPanelUrl().'/type/'.$type->id.'/delete', 'deleteConfirmMsg' => trans('update.delete_confirm_msg')])
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
