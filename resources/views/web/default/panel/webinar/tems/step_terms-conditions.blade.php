
@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/admin/css/no-result-bg.css">
@endpush

@section('content')
<div class="card border-0 shadow-sm px-35 py-50">
    @foreach($contents as $content)
    {!! $content->content !!}
@endforeach
</div>

@endsection


@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
@endpush
