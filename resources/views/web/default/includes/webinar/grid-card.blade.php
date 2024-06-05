{{-- @include(getTemplate() . '.includes.webinar.grid-card', ['bestRateWebinars' => $bestRateWebinars]) --}}

<div class="webinar-card card-radius">
    <figure>
        <div class="image-box overflow-hidden">

            @if(isset($webinar) && !empty($webinar))

                @php
                    $isBestRateWebinar = !empty($bestRateWebinars) && in_array($webinar->id, $bestRateWebinars->pluck('id')->toArray());
                @endphp

                @if(auth()->check() && auth()->user()->is_member_aaipi == 1)
                    @if(!$isBestRateWebinar)
                        @if(Auth::check())
                            @if($webinar->bestTicket() < $webinar->price)
                                <span class="badge badge-danger">{{ trans('public.offer',['off' => $webinar->bestTicket(true)['percent']]) }}</span>
                            @elseif(empty($isFeature) && !empty($webinar->feature))
                                <span class="badge badge-warning">{{ trans('home.featured') }}</span>
                            @elseif($webinar->type == 'webinar')
                                @if($webinar->start_date > time())
                                    <span class="badge badge-primary">{{ trans('panel.not_conducted') }}</span>
                                @elseif($webinar->isProgressing())
                                    <span class="badge badge-secondary">{{ trans('webinars.in_progress') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ trans('public.finished') }}</span>
                                @endif
                            @elseif(!empty($webinar->type))
                                <span class="badge badge-primary">{{ trans('webinars.'.$webinar->type) }}</span>
                            @endif
                        @endif
                    @endif
                @else
                    @if(!$isBestRateWebinar)
                        @if(Auth::check())
                            @if($webinar->bestTicketGuest() < $webinar->price_guest)
                                <span class="badge badge-danger">{{ trans('public.offer',['off' => $webinar->bestTicketGuest(true)['percent']]) }}</span>
                            @elseif(empty($isFeature) && !empty($webinar->feature))
                                <span class="badge badge-warning">{{ trans('home.featured') }}</span>
                            @elseif($webinar->type == 'webinar')
                                @if($webinar->start_date > time())
                                    <span class="badge badge-primary">{{ trans('panel.not_conducted') }}</span>
                                @elseif($webinar->isProgressing())
                                    <span class="badge badge-secondary">{{ trans('webinars.in_progress') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ trans('public.finished') }}</span>
                                @endif
                            @elseif(!empty($webinar->type))
                                <span class="badge badge-primary">{{ trans('webinars.'.$webinar->type) }}</span>
                            @endif
                        @endif
                    @endif                
                @endif
                    
            @endif
                    
            <a href="{{ $webinar->getUrl() }}">
                <img src="{{ $webinar->getImage() }}" onerror="this.onerror=null;this.src='{{createImageTitle($webinar->title)}}';" class="lazyload img-cover" alt="{{ $webinar->title }}">
            </a>

            @if(!$isBestRateWebinar)

                @if(Auth::check())
                    @if ($webinar->checkShowProgress())
                        <div class="progress">
                            <span class="progress-bar" style="width: {{ $webinar->getProgress() }}%"></span>
                        </div>
                    @endif
                @endif
                    
                @if($webinar->type == 'webinar')
                    @if(Auth::check())
                        <a href="{{ $webinar->addToCalendarLink() }}" target="_blank" class="webinar-notify d-flex align-items-center justify-content-center mb-25">
                            <i data-feather="bell" width="20" height="20" class="webinar-icon"></i>
                        </a>
                    @else
                        <a href="/login" class="webinar-notify d-flex align-items-center justify-content-center mb-25">
                            <i data-feather="bell" width="20" height="20" class="webinar-icon"></i>
                        </a>
                    @endif
                @endif

            @endif

        </div>

        <figcaption class="webinar-card-body card-radius-bottom {{ $isBestRateWebinar ? 'best-rate-webinar' : '' }}">
            <div class="d-flex justify-content-between flex-wrap">
                {{-- <div class="d-flex justify-content-center align-items-center text-center {{ strlen($webinar->category->title) > 20 ? ' mb-10' : '' }}"> --}}
                    <div class="d-flex justify-content-center align-items-center text-center mb-10" 
                        @if(optional($webinar->category)->title)
                            data-toggle="tooltip" data-placement="top" title="{{ $webinar->category->title }}"
                        @endif
                        style="cursor: pointer"
                    >
                        @if($webinar->category)
                            <a href="{{ $webinar->category->getUrl() }}" target="_blank" class="badge badge-primary rounded-pill py-2 px-3" title="{{ $webinar->category->title }}">
                                {{ Str::limit($webinar->category->title, 15) }}
                            </a>
                        @endif
                    </div>

                @include(getTemplate() . '.includes.webinar.rate', ['rate' => $webinar->getRate()])
            </div>

            <a href="{{ $webinar->getUrl() }}" class="title">
                <h3 class="mt-5 webinar-title font-weight-bold font-16 text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ $webinar->title }}</h3>
            </a>

            <div class="d-flex justify-content-between mt-20">
                <div>
                    <div class="user-inline-avatar d-flex align-items-center">
                        <div class="avatar bg-gray200 avatar-size rounded-circle overflow-hidden">
                            <img src="{{ $webinar->teacher->getAvatar() }}" class="img-cover" alt="{{ $webinar->teacher->full_name }}">
                        </div>
                        <a href="{{ $webinar->teacher->getProfileUrl() }}" target="_blank" class="user-name ml-5 text-dark-blue font-14 {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ $webinar->teacher->full_name }}</a>
                    </div>
                </div>
                <div>
                    <div class="webinar-price-box mt-5">
                        @if(auth()->check() && auth()->user()->is_member_aaipi == 1)
                            @if(!empty($isRewardCourses) && !empty($webinar->points))
                                <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }} font-14">{{ $webinar->points }} {{ trans('update.points') }}</span>
                            @elseif(!empty($webinar->price) && $webinar->price > 0)
                                @if($webinar->bestTicket() < $webinar->price)
                                    <span class="off ml-10">{{ handlePrice($webinar->price, true, true, false, null, true) }}</span>
                                    <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ handlePrice($webinar->bestTicket(), true, true, false, null, true) }}</span>
                                @else
                                    <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ handlePrice($webinar->price, true, true, false, null, true) }}</span>
                                @endif
                            @else
                                <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }} font-14">{{ trans('public.free') }}</span>
                            @endif
                        @else
                            @if(!empty($isRewardCourses) && !empty($webinar->points))
                                <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }} font-14">{{ $webinar->points }} {{ trans('update.points') }}</span>
                            @elseif(!empty($webinar->price_guest) && $webinar->price_guest > 0)
                                @if($webinar->bestTicketGuest() < $webinar->price_guest)
                                    <span class="off ml-10">{{ handlePriceGuest($webinar->price_guest, true, true, false, null, true) }}</span>
                                    <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ handlePriceGuest($webinar->bestTicketGuest(), true, true, false, null, true) }}</span>
                                @else
                                    <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }}">{{ handlePriceGuest($webinar->price_guest, true, true, false, null, true) }}</span>
                                @endif
                            @else
                                <span class="real text-dark-blue {{ $isBestRateWebinar ? 'color-text-best-rate' : '' }} font-14">{{ trans('public.free') }}</span>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </figcaption>
    </figure>
</div>
