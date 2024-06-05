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
                                    @foreach($contents as $content)
                                    {!! $content->content !!}
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
