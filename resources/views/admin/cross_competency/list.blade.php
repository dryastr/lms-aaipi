@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.cross_competency') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{ trans('admin/pages/cross_competency.admin_cross_competency_page_title') }}</div>
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
                                        <th class="text-left">{{ trans('admin/main.name_list') }}</th>
                                        <th class="text-left">{{ trans('admin/main.types_list') }}</th>
                                        <th>{{ trans('admin/main.action') }}</th>
                                    </tr>
                                    @if($cross_competency->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">{{ trans('admin/main.no_data_available') }}</td>
                                        </tr>
                                    @else
                                    @foreach($cross_competency as $crosscom)
                                        <tr>
                                            <td class="text-left">{{ $crosscom->name }}</td>
                                            <td class="text-left">{{ $crosscom->types }}</td>
                                            <td>
                                                @can('admin_group_edit')
                                                <a href="{{ getAdminPanelUrl() }}/cross-competency/{{ $crosscom->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan

                                                @can('admin_group_delete')
                                                @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/cross-competency/'.$crosscom->id.'/delete', 'deleteConfirmMsg' => trans('update.delete_item')])

                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $cross_competency->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
