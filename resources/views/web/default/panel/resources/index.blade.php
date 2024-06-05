@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/css/panel.css">
    <link rel="stylesheet" href="/assets/aaipi/css/panel/style.css">
@endpush

@section('content')
    <section class="mt-15">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">{{ trans('panel.my_resources') }}</h2>

            {{-- <form action="" method="get">
                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="cursor-pointer mb-0 mr-10 font-weight-500 font-14 text-gray" for="conductedSwitch">{{ trans('panel.only_not_conducted_webinars') }}</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="not_conducted" @if(request()->get('not_conducted','') == 'on') checked @endif class="custom-control-input" id="conductedSwitch">
                        <label class="custom-control-label" for="conductedSwitch"></label>
                    </div>
                </div>
            </form> --}}
        </div>

        @if(!empty($resources) and !$resources->isEmpty())
            @foreach($resources as $resource)
                <div class="row mt-30">
                    <div class="col-12">
                        <div class="webinar-card webinar-card-custom webinar-list d-flex">
                            <div class="image-box">
                                <img src="{{ $resource->getImage() }}" class="img-cover" alt="">

                                <div class="badge-position-custom">
                                    @switch($resource->status)
                                        @case(\App\Models\Resources::$active)
                                            @break
                                        @case(\App\Models\Resources::$isDraft)
                                            <span class="badge badge-danger">{{ trans('public.draft') }}</span>
                                            @break
                                        @case(\App\Models\Resources::$pending)
                                            <span class="badge badge-warning">{{ trans('public.waiting') }}</span>
                                            @break
                                        @case(\App\Models\Resources::$inactive)
                                            <span class="badge badge-danger">{{ trans('public.rejected') }}</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ $resource->getUrl() }}" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold">{{ $resource->title }}
                                            {{-- <span class="badge badge-dark ml-10 status-badge-dark">{{ trans('resources.'.$resource->category['']) }}</span> --}}
                                        </h3>
                                    </a>

                                    {{-- @if($resource->isOwner($authUser->id)) --}}
                                        <div class="btn-group dropdown table-actions">
                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" height="20"></i>
                                            </button>
                                            <div class="dropdown-menu ">

                                                <a href="/panel/resources/{{ $resource->id }}/edit" class="webinar-actions d-block mt-10">{{ trans('public.edit') }}</a>

                                                <a href="/panel/resources/{{ $resource->id }}/export-students-list" class="webinar-actions d-block mt-10">{{ trans('public.export_list') }}</a>

                                                @if($authUser->id == $resource->creator_id)
                                                    <a href="/panel/resources/{{ $resource->id }}/duplicate" class="webinar-actions d-block mt-10">{{ trans('public.duplicate') }}</a>
                                                @endif


                                                <a href="/panel/resources/{{ $resource->id }}/statistics" class="webinar-actions d-block mt-10">{{ trans('update.statistics') }}</a>

                                                @if($resource->creator_id == $authUser->id)
                                                    <a href="/panel/resources/{{ $resource->id }}/delete" class="webinar-actions d-block mt-10 text-danger delete-action">{{ trans('public.delete') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    {{-- @endif --}}
                                </div>

                                <div class="webinar-price-box mt-15">
                                    @if($resource->price > 0)
                                        @if($resource->bestTicket() < $resource->price)
                                            <span class="real">{{ handlePrice($resource->bestTicket(), true, true, false, null, true) }}</span>
                                            <span class="off ml-10">{{ handlePrice($resource->price, true, true, false, null, true) }}</span>
                                        @else
                                            <span class="real">{{ handlePrice($resource->price, true, true, false, null, true) }}</span>
                                        @endif
                                    @else
                                        <span class="real">{{ trans('public.free') }}</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">{{ trans('public.item_id') }}:</span>
                                        <span class="stat-value">{{ $resource->id }}</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">{{ trans('public.category') }}:</span>
                                        <span class="stat-value">{{ !empty($resource->category_id) ? $resource->category->title : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="my-30">
                {{ $resources->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>

        @else
            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'webinar.png',
                'title' => trans('panel.you_not_have_any_webinar'),
                'hint' =>  trans('panel.no_result_hint') ,
                'btn' => ['url' => '/panel/resources/new','text' => trans('panel.create_a_webinar') ]
            ])
        @endif

    </section>
@endsection