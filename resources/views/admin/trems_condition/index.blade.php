@extends('admin.layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.trem_conditions') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/main.trem_conditions') }}</div>
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
                                        <th class="text-left">{{ trans('admin/main.trem_conditions') }}</th>
                                        <th class="text-left">{{ trans('admin/main.actions') }}</th>
                                    </tr>
                                    @foreach($trem as $group)
                                    <tr>
                                        <td class="text-left">
                                            <span>{{ $group->id }}</span>
                                        </td>
                                        <td class="text-left">{{ Str::limit(strip_tags($group->content), 500) }}</td> 
                                        <td class="text-left">
                                            <div class="d-flex">
                                                @can('admin_group_edit')
                                                    <a href="{{ getAdminPanelUrl() }}/terms-condition/{{ $group->id }}/edit" class="btn-transparent  text-primary text-d-none mr-1" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                 @endcan
    
                                                    <a href="{{ getAdminPanelUrl() }}/terms-condition/show" target="_blank"  class="btn-transparent  text-primary text-d-none mr-1" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.show') }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                    
                                                @can('admin_group_delete')
                                                    @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/terms-condition/'.$group->id.'/delete', 'deleteConfirmMsg' => trans('update.thematic_delete_confirm_msg')])
                                                @endcan
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-footer text-center">
                        {{ $city->appends(request()->input())->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
