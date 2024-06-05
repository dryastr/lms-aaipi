@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/chartjs/chart.min.css"/>
@endpush

@section('content')

    <section>
        <h2 class="section-title">{{ $resource->title }}</h2>

        <div class="container">
            <div class="row">
                @include('web.default.panel.resources.resource_statistics.includes.pie_charts', [
                    'cardTitle' => 'Total Download',
                    'cardId' => 'resourceDownloadsPieChart',
                    'cardPrimaryLabel' => 'Total Download',
                ])
                @include('web.default.panel.resources.resource_statistics.includes.pie_charts', [
                    'cardTitle' => 'Total Peran Pengguna',
                    'cardId' => 'resourceUserRolesPieChart',
                    'cardPrimaryLabel' => trans('public.students'),
                    'cardSecondaryLabel' => 'Admin',
                    'cardWarningLabel' => trans('home.organizations'),
                ])
            </div>
        </div>
    </section>

    <section class="mt-35">
        <h2 class="section-title">{{ trans('panel.students_list') }}</h2>

        @if(!empty($userDownloads) and !$userDownloads->isEmpty())
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left text-gray">{{ trans('public.name') }}</th>
                                    <th class="text-left text-gray">{{ trans('public.total_downloads') }}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($userDownloads as $user)

                                    <tr>
                                        <td class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="{{ $user->getAvatar() }}" class="img-cover" alt="">
                                                </div>
                                                <div class=" ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500">{{ $user->full_name }}</span>
                                                    <span class="mt-5 d-block font-12 text-gray">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <span class="text-dark-blue font-weight-500">{{ $user->total_downloads }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-30">
                {{ $userDownloads->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        @else

            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'studentt.png',
                'title' => trans('update.course_statistic_students_no_result'),
                'hint' =>  nl2br(trans('update.course_statistic_students_no_result_hint')),
            ])
        @endif

    </section>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="/assets/default/js/panel/resource_statistics.min.js"></script>

    <script>
        (function ($) {
            "use strict";

            @if(isset($downloadsCount))
            makeDownloadsPieChart('resourceDownloadsPieChart', ['Downloads'], [{{ $downloadsCount }}]);
            @endif
            
            @if(isset($userRoleDownloads) && $userRoleDownloads->isNotEmpty())
            let userRolesLabels = @json($userRoleDownloads->pluck('role_name'));
            let userRolesData = @json($userRoleDownloads->pluck('total_downloads'));
            makeUserRolesPieChart('resourceUserRolesPieChart', userRolesLabels, userRolesData);
            @endif

        })(jQuery)
    </script>
@endpush
