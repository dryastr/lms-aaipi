@extends('admin.layouts.app')

@section('content')


    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.dpw') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.dpw') }}</div>
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
                                        <th class="text-left">{{ trans('admin/main.name') }}</th>
                                        <th>{{ trans('admin/main.mobile') }}</th>
                                        <th>{{ trans('admin/main.provinsi') }}</th>
                                        <th>{{ trans('admin/main.kabupaten') }}</th>
                                        {{-- <th>{{ trans('admin/main.actions') }}</th> --}}
                                    </tr>
                                    @foreach($groups as $group)
                                    <tr class="{{ is_null($group->parent_id) ? 'parent-row' : 'child-row' }}">
                                        <td class="text-left">
                                            <span>{{ $group->full_name }}</span>
                                        </td>
                                    <td>{{ $group->mobile }}</td>
                                    <td>{{ $group->province_name }}</td>
                                    <td>{{ $group->city_name }}</td>
                                        {{-- <td>
                                            @can('admin_group_edit')
                                                <a href="{{ getAdminPanelUrl() }}/tematik/{{ $group->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                
                                            @can('admin_group_delete')
                                                @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/tematik/'.$group->id.'/delete', 'deleteConfirmMsg' => trans('update.thematic_delete_confirm_msg')])
                                            @endcan
                                        </td> --}}
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
