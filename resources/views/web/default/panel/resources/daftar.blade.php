@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/admin/css/no-result-bg.css">
@endpush

@section('content')
    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">{{ trans('update.resources') }}</h2>
        </div>
        <div class="panel-section-card py-20 px-25 mt-20">
            <div class="row">
                <div class="col-12 ">
                    @if($userDownloads->isEmpty())
                        <p class="text-center">{{ trans('public.no_data_available') }}</p>
                    @else
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-center">{{ trans('public.name') }}</th>
                                    <th class="text-center">{{ trans('update.resources') }}</th>
                                    <th class="text-center">{{ trans('public.tanggal_download') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userDownloads as $download)
                                    <tr>
                                        <td class="text-center align-middle">{{ $download->user->full_name }}</td>
                                        <td class="text-center align-middle">{{ $download->resource->title }}</td>                                       
                                        <td class="text-center align-middle">{{ $download->date->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
@endpush
