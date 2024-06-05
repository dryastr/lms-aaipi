@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ trans('admin/main.support_departments') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ trans('admin/main.departments') }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body col-12">
                    <div class="tabs">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link{{ $errors->any() ? '' : ' active' }}" href="#list" data-toggle="tab"> {{ trans('admin/main.departments') }} </a></li>
                            <li class="nav-item"><a class="nav-link{{ $errors->any() ? ' active' : '' }}" href="#newitem" data-toggle="tab">{{ trans('admin/main.new_department') }}</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="list" class="tab-pane{{ $errors->any() ? '' : ' active' }}">
                                <div class="table-responsive">
                                    <table class="table table-striped font-14">

                                        <tr>
                                            <th>{{ trans('admin/main.department') }}</th>
                                            <th class="text-center" width="200">{{ trans('admin/main.conversations') }}</th>
                                            <th class="text-center" width="100">{{ trans('admin/main.actions') }}</th>
                                        </tr>

                                        @foreach($departments as $department)
                                            <tr>
                                                <td>
                                                    <span>{{ $department->title }}</span>
                                                </td>

                                                <td>{{ $department->supports_count }}</td>

                                                <td class="text-center">
                                                    @can('admin_support_departments_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/supports/departments/{{ $department->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('admin_support_departments_delete')
                                                        @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/supports/departments/'. $department->id.'/delete','btnClass' => ''])
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>

                                <div class="text-center mt-2">
                                    {{ $departments->links() }}@extends('admin.layouts.app')

                                    @section('content')
                                        <section class="section">
                                            <div class="section-header">
                                                <h1>{{ trans('admin/main.support_departments') }}</h1>
                                                <div class="section-header-breadcrumb">
                                                    <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
                                                    </div>
                                                    <div class="breadcrumb-item">{{ trans('admin/main.departments') }}</div>
                                                </div>
                                            </div>
                                    
                                            <div class="section-body">
                                                <div class="card">
                                                    <div class="card-body col-12">
                                                        <div class="tabs">
                                                            <ul class="nav nav-pills">
                                                                <li class="nav-item"><a class="nav-link{{ $errors->any() ? '' : ' active' }}" href="#list" data-toggle="tab"> {{ trans('admin/main.departments') }} </a></li>
                                                                <li class="nav-item"><a class="nav-link{{ $errors->any() ? ' active' : '' }}" href="#newitem" data-toggle="tab">{{ trans('admin/main.new_department') }}</a></li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <div id="list" class="tab-pane{{ $errors->any() ? '' : ' active' }}">
                                                                <div class="table-responsive">
                                                                        <table class="table table-striped font-14">
                                    
                                                                            <tr>
                                                                                <th>{{ trans('admin/main.department') }}</th>
                                                                                <th class="text-center" width="200">{{ trans('admin/main.conversations') }}</th>
                                                                                <th class="text-center" width="100">{{ trans('admin/main.actions') }}</th>
                                                                            </tr>
                                    
                                                                            @foreach($departments as $department)
                                                                                <tr>
                                                                                    <td>
                                                                                        <span>{{ $department->title }}</span>
                                                                                    </td>
                                    
                                                                                    <td>{{ $department->supports_count }}</td>
                                    
                                                                                    <td class="text-center">
                                                                                        @can('admin_support_departments_edit')
                                                                                            <a href="{{ getAdminPanelUrl() }}/supports/departments/{{ $department->id }}/edit" class="btn-transparent  text-primary text-d-none" data-toggle="tooltip" data-placement="top" title="{{ trans('admin/main.edit') }}">
                                                                                                <i class="fa fa-edit"></i>
                                                                                            </a>
                                                                                        @endcan
                                    
                                                                                        @can('admin_support_departments_delete')
                                                                                            @include('admin.includes.delete_button',['url' => getAdminPanelUrl().'/supports/departments/'. $department->id.'/delete','btnClass' => ''])
                                                                                        @endcan
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                    
                                                                        </table>
                                                                    </div>
                                    
                                                                    <div class="text-center mt-2">
                                                                        {{ $departments->links() }}
                                                                    </div>
                                                                </div>
                                    
                                                                <div id="newitem" class="tab-pane{{ $errors->any() ? ' active' : '' }}">
                                                                    <!-- Isi tab new_department -->
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <form action="{{ getAdminPanelUrl() }}/supports/departments/store" method="Post" id="departmentForm">
                                                                                {{ csrf_field() }}
                                                                                @if(!empty(getGeneralSettings('content_translate')))
                                                                                    <div class="form-group">
                                                                                        <label class="input-label">{{ trans('auth.language') }}</label>
                                                                                        <select name="locale" class="form-control {{ !empty($department) ? 'js-edit-content-locale' : '' }}">
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
                                                                                    <label>{{ trans('admin/main.title') }}<span class="text-danger">*</span></label>
                                                                                    <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}"/>
                                                                                    @error('title')
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
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    @endsection
                                    
                                    @push('scripts_bottom')
                                        <script>
                                            @if ($errors->any())
                                                $(document).ready(function () {
                                                    $('a[href="#newitem"]').tab('show');
                                                });
                                            @endif
                                        </script>
                                    @endpush
                                    
                                    {{ $departments->appends(request()->input())->links() }}
                                </div>
                            </div>

                            <div id="newitem" class="tab-pane{{ $errors->any() ? ' active' : '' }}">
                                <!-- Isi tab new_department -->
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ getAdminPanelUrl() }}/supports/departments/store" method="Post" id="departmentForm">
                                            {{ csrf_field() }}
                                            @if(!empty(getGeneralSettings('content_translate')))
                                                <div class="form-group">
                                                    <label class="input-label">{{ trans('auth.language') }}</label>
                                                    <select name="locale" class="form-control {{ !empty($department) ? 'js-edit-content-locale' : '' }}">
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
                                                <label>{{ trans('admin/main.title') }}<span class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}"/>
                                                @error('title')
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
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        // Script untuk redirect ke tab New Department jika terjadi error pada validasi input
        @if ($errors->any())
            $(document).ready(function () {
                $('a[href="#newitem"]').tab('show');
            });
        @endif
    </script>
@endpush
