@extends('admin.layouts.app')

@push('styles_top')
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">

            {{-- <section class="card">
                <div class="card-body">

                </div>
            </section> --}}

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">                        
                        <div class="card-body">
                            <form method="get" class="mb-0">
    
                                <div class="d-flex justify-content-end">
                                    <div class="form-group">
                                        {{-- <label class="input-label">{{trans('admin/main.search')}}</label> --}}
                                        <div class="d-flex w-100">
                                            <input type="text" name="full_name" class="form-control" value="{{ request()->get('full_name') }}" placeholder="{{ trans('public.search_user') }}" style="border-radius: 5px 0px 0px 5px"/>
                                            <button type="submit" class="btn btn-primary" style="border-radius: 0px 5px 5px 0px">
                                                {{ trans('home.find') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">     
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="input-label mb-4"> </label>
                                            <input type="submit" class="text-center btn btn-primary w-100" value="{{trans('admin/main.show_results')}}">
                                        </div>
                                    </div>
                                </div> --}}
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>{{ trans('admin/main.id') }}</th>
                                        <th class="text-left">{{ trans('admin/main.name') }}</th>
                                        <th>{{ trans('admin/main.role_name') }}</th>
                                        <th>{{ trans('admin/main.register_date') }}</th>
                                        <th>{{ trans('admin/main.status') }}</th>
                                        <th>{{ trans('admin/main.kabupaten') }}</th>
                                        <th>{{ trans('admin/main.provinsi') }}</th>
                                        <th width="120">{{ trans('admin/main.actions') }}</th>
                                    </tr>
                                    {{-- {{dd($dpwRoles)}} --}}
                                    @foreach($users as $user)
                                    @if($user->role_name == \App\Models\Role::$dpw)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td class="text-left">
                                                <div class="d-flex align-items-center">
                                                    <figure class="avatar mr-2">
                                                        <img src="{{ $user->getAvatar() }}" alt="{{ $user->full_name }}">
                                                    </figure>
                                                    <div class="media-body ml-1">
                                                        <div class="mt-0 mb-1 font-weight-bold">{{ $user->full_name }}</div>

                                                        @if($user->mobile)
                                                            <div class="text-primary text-small font-600-bold">{{ $user->mobile }}</div>
                                                        @endif

                                                        @if($user->email)
                                                            <div class="text-primary text-small font-600-bold">{{ $user->email }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-center">{{ $user->role->caption }}</td>
                                            {{-- <td>{{ dateTimeFormat($user->created_at, 'j M Y | H:i') }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('j F Y | H:i') }}</td>

                                            <td>
                                                <div class="media-body">
                                                    @if($user->ban and !empty($user->ban_end_at) and $user->ban_end_at > time())
                                                        <div class="mt-0 mb-1 font-weight-bold text-danger">{{ trans('admin/main.ban') }}</div>
                                                        <div class="text-small font-600-bold">Until {{ dateTimeFormat($user->ban_end_at, 'Y/m/j') }}</div>
                                                    @else
                                                        <div class="mt-0 mb-1 font-weight-bold {{ ($user->status == 'active') ? 'text-success' : 'text-warning' }}">{{ trans('admin/main.'.$user->status) }}</div>
                                                        <div class="text-small font-600-bold {{ ($user->verified ? ' text-success ' : ' text-warning ') }}">({{ trans('public.'.($user->verified ? 'verified' : 'not_verified')) }})</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($user->petaKabkota)
                                                    {{ $user->petaKabkota->kabupaten_name }}
                                                @else
                                                    {{ trans('admin/main.no_kabkota_data_available') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->petaProvinsi)
                                                    {{ $user->petaProvinsi->propinsi_name }}
                                                @else
                                                    {{ trans('admin/main.no_province_data_available') }}
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center justify-content-center text-center" width="120">

                                                <div class="mr-1">
                                                    @can('admin_users_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/users/{{ $user->id }}/edit" class="btn-transparent text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </div>

                                                <div class="">
                                                    @can('admin_users_delete')
                                                        @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/users/'.$user->id.'/delete' , 'btnClass' => '', 'deleteConfirmMsg' => trans('update.user_delete_confirm_msg')])
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
