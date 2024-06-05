@extends('admin.layouts.app')

@push('libraries_top')
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.theme.min.css">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" /> --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="/assets/aaipi/css/admin/admin-dashboard.css">
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> --}}
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

@section('content')

    <section class="section">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg mb-25" data-background="{{ !empty(getPageBackgroundSettings('admin_dashboard')) ? getPageBackgroundSettings('admin_dashboard') : '' }}">
                    <div class="hero-inner">
                        <h2>{{trans('admin/main.welcome')}}, {{ $authUser->full_name }}!</h2>

                        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                            @can('admin_general_dashboard_quick_access_links')
                                <div>
                                    <p class="lead">{{trans('admin/main.welcome_card_text')}}</p>

                                    <div class="mt-2 mb-2 d-flex flex-column flex-md-row">
                                        <a href="{{ getAdminPanelUrl() }}/comments/webinars" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-comment"></i>{{trans('admin/main.comments')}} </a>
                                        <a href="{{ getAdminPanelUrl() }}/supports" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-envelope"></i>{{trans('admin/main.tickets')}}</a>
                                        <a href="{{ getAdminPanelUrl() }}/reports/webinars" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="fas fa-info"></i>{{trans('admin/main.reports')}}</a>
                                    </div>
                                </div>
                            @endcan

                            @can('admin_clear_cache')
                                <div class="w-xs-to-lg-100">
                                    <p class="lead d-none d-lg-block">&nbsp;</p>

                                    @include('admin.includes.delete_button',[
                                             'url' => getAdminPanelUrl().'/clear-cache',
                                             'btnClass' => 'btn btn-outline-white btn-lg btn-icon icon-left mt-2 w-100',
                                             'btnText' => trans('admin/main.clear_all_cache'),
                                             'hideDefaultClass' => true
                                          ])
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card card-maps m-0">
                    <div class="back-map-place w-100 d-none">
                        <button class="btn btn-primary-maps w-100" id="backMap">Kembali</button>
                    </div>
                    <div id="loader" class="map-loading-overlay">
                        <div class="map-loading-spinner"></div>
                    </div>
                    <div id='map' class="mt-25 w-100" height="25rem"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                @can('admin_general_dashboard_daily_sales_statistics')
                    @if(!empty($dailySalesTypeStatistics))
                        <div class="card card-statistic-2">
                            <div class="card-stats">
                                <div class="card-stats-title">{{trans('admin/main.daily_sales_type_statistics')}}</div>

                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $dailySalesTypeStatistics['webinarsSales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.live_class')}}</div>
                                    </div>

                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $dailySalesTypeStatistics['courseSales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.course')}}</div>
                                    </div>

                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $dailySalesTypeStatistics['appointmentSales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.appointment')}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{trans('admin/main.today_sales')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $dailySalesTypeStatistics['allSales'] }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endcan
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12">
                @can('admin_general_dashboard_income_statistics')
                    @if(!empty($getIncomeStatistics))
                        <div class="card card-statistic-2">
                            <div class="card-stats">
                                <div class="card-stats-title">{{trans('admin/main.income_statistics')}}</div>

                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ handlePrice($getIncomeStatistics['todaySales']) }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.today')}}</div>
                                    </div>

                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ handlePrice($getIncomeStatistics['monthSales']) }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.this_month')}}</div>
                                    </div>

                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ handlePrice($getIncomeStatistics['yearSales']) }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.this_year')}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{trans('admin/main.total_incomes')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ handlePrice($getIncomeStatistics['totalSales']) }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endcan
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                @can('admin_general_dashboard_total_sales_statistics')
                    @if(!empty($getTotalSalesStatistics))
                        <div class="card card-statistic-2">
                            <div class="card-stats">
                                <div class="card-stats-title">{{trans('admin/main.salescount')}}</div>

                                <div class="card-stats-items">
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $getTotalSalesStatistics['todaySales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.today')}}</div>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $getTotalSalesStatistics['monthSales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.this_month')}}</div>
                                    </div>
                                    <div class="card-stats-item">
                                        <div class="card-stats-item-count">{{ $getTotalSalesStatistics['yearSales'] }}</div>
                                        <div class="card-stats-item-label">{{trans('admin/main.this_year')}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>

                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{trans('admin/main.total_sales')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{ $getTotalSalesStatistics['totalSales'] }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endcan
            </div>
        </div>

        <div class="row">

            @can('admin_general_dashboard_new_sales')
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ getAdminPanelUrl() }}/financial/sales" class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{trans('admin/main.new_sale')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewSalesCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('admin_general_dashboard_new_comments')
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ getAdminPanelUrl() }}/comments/webinars" class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-comment"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{trans('admin/main.new_comment')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewCommentsCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('admin_general_dashboard_new_tickets')
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="{{ getAdminPanelUrl() }}/supports" class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-envelope"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{trans('admin/main.new_ticket')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewTicketsCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('admin_general_dashboard_new_reviews')
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-eye"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{trans('admin/main.pending_review_classes')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $getPendingReviewCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

        </div>


        <div class="row">
            @can('admin_general_dashboard_sales_statistics_chart')
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card" style="height: 96%">
                        <div class="card-header">
                            <h4>{{trans('admin/main.sales_statistics')}}</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <button type="button" class="js-sale-chart-month btn">{{trans('admin/main.month')}}</button>
                                    <button type="button" class="js-sale-chart-year btn btn-primary">{{trans('admin/main.year')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="position-relative">
                                        <canvas id="saleStatisticsChart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    @if(!empty($getMonthAndYearSalesChartStatistics))
                                        <div class="statistic-details mt-4 position-relative">
                                            <div class="statistic-details-item">
                                                <span class="text-muted">
                                                    @if($getMonthAndYearSalesChartStatistics['todaySales']['grow_percent']['status'] == 'up')
                                                        <span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                                    @endif

                                                    {{ $getMonthAndYearSalesChartStatistics['todaySales']['grow_percent']['percent'] }}
                                                </span>

                                                <div class="detail-value">{{ handlePrice($getMonthAndYearSalesChartStatistics['todaySales']['amount']) }}</div>
                                                <div class="detail-name">{{trans('admin/main.today_sales')}}</div>
                                            </div>
                                            <div class="statistic-details-item">
                                                <span class="text-muted">
                                                    @if($getMonthAndYearSalesChartStatistics['weekSales']['grow_percent']['status'] == 'up')
                                                        <span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                                    @endif

                                                    {{ $getMonthAndYearSalesChartStatistics['weekSales']['grow_percent']['percent'] }}
                                                </span>

                                                <div class="detail-value">{{ handlePrice($getMonthAndYearSalesChartStatistics['weekSales']['amount']) }}</div>
                                                <div class="detail-name">{{trans('admin/main.week_sales')}}</div>
                                            </div>
                                            <div class="statistic-details-item">
                                                <span class="text-muted">
                                                    @if($getMonthAndYearSalesChartStatistics['monthSales']['grow_percent']['status'] == 'up')
                                                        <span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                                    @endif

                                                    {{ $getMonthAndYearSalesChartStatistics['monthSales']['grow_percent']['percent'] }}
                                                </span>

                                                <div class="detail-value">{{ handlePrice($getMonthAndYearSalesChartStatistics['monthSales']['amount']) }}</div>
                                                <div class="detail-name">{{trans('admin/main.month_sales')}}</div>
                                            </div>
                                            <div class="statistic-details-item">
                                                <span class="text-muted">
                                                    @if($getMonthAndYearSalesChartStatistics['yearSales']['grow_percent']['status'] == 'up')
                                                        <span class="text-primary"><i class="fas fa-caret-up"></i></span>
                                                    @else
                                                        <span class="text-danger"><i class="fas fa-caret-down"></i></span>
                                                    @endif

                                                    {{ $getMonthAndYearSalesChartStatistics['yearSales']['grow_percent']['percent'] }}
                                                </span>

                                                <div class="detail-value">{{ handlePrice($getMonthAndYearSalesChartStatistics['yearSales']['amount']) }}</div>
                                                <div class="detail-name">{{trans('admin/main.year_sales')}}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('admin_general_dashboard_recent_comments')
                <div class="col-lg-4 col-md-12 col-12 col-sm-12 @if(count($recentComments) < 5) pb-30 @endif">
                    <div class="card @if(count($recentComments) < 5) h-100 @endif" style="height: 96%">
                        <div class="card-header">
                            <h4>{{trans('admin/main.recent_comments')}}</h4>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach($recentComments as $recentComment)
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" height="50" src="{{ $recentComment->user->getAvatar() }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary font-12">{{ dateTimeFormat($recentComment->created_at, 'j M Y | H:i') }}</div>
                                            <div class="media-title">{{ $recentComment->user->full_name }}</div>
                                            <span class="text-small text-muted">{{ truncate($recentComment->comment, 150) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-center pt-1 pb-1 mt-5">
                                <a href="{{ getAdminPanelUrl() }}/comments/webinars" class="btn btn-primary btn-lg btn-round ">
                                    {{trans('admin/main.view_all')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>


        <div class="row">

            @can('admin_general_dashboard_recent_tickets')
                @if(!empty($recentTickets))
                    <div class="col-md-4">
                        <div class="card card-hero" style="height: 96%">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>{{trans('admin/main.recent_tickets')}}</h5>
                                <div class="card-description">{{ $recentTickets['pendingReply'] }} {{ trans('admin/main.pending_reply') }}</div>
                            </div>

                            <div class="card-body p-0">
                                <div class="tickets-list">

                                    @foreach($recentTickets['tickets'] as $ticket)
                                        <a href="{{ getAdminPanelUrl() }}/supports/{{ $ticket->id }}/conversation" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $ticket->title }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $ticket->user->full_name }}</div>
                                                <div class="bullet"></div>
                                                @if($ticket->status == 'replied' or $ticket->status == 'open')
                                                    <span class="text-warning  text-small font-600-bold">{{ trans('admin/main.pending_reply') }}</span>
                                                @elseif($ticket->status == 'close')
                                                    <span class="text-danger  text-small font-600-bold">{{ trans('admin/main.close') }}</span>
                                                @else
                                                    <span class="text-primary  text-small font-600-bold">{{ trans('admin/main.replied') }}</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach

                                    <a href="{{ getAdminPanelUrl() }}/supports" class="ticket-item ticket-more">
                                        {{trans('admin/main.view_all')}} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan

            @can('admin_general_dashboard_recent_webinars')
                @if(!empty($recentWebinars))
                    <div class="col-md-4">
                        <div class="card card-hero" style="height: 96%">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>{{trans('admin/main.recent_live_classes')}}</h5>
                                <div class="card-description">{{ $recentWebinars['pendingReviews'] }} {{trans('admin/main.pending_review')}}</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    @foreach($recentWebinars['webinars'] as $webinar)
                                        <a href="{{ getAdminPanelUrl() }}/webinars/{{ $webinar->id }}/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $webinar->title }}</h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div>{{ $webinar->teacher->full_name }}</div>
                                                <div class="bullet"></div>
                                                @switch($webinar->status)
                                                    @case(\App\Models\Webinar::$active)
                                                    <span class="text-success">{{ trans('admin/main.publish') }}</span>
                                                    @if($webinar->isProgressing())
                                                        <div class="text-warning text-small font-600-bold">({{  trans('webinars.in_progress') }})</div>
                                                    @elseif($webinar->start_date > time())
                                                        <div class="text-danger text-small font-600-bold">({{  trans('admin/main.not_conducted') }})</div>
                                                    @else
                                                        <span class="text-success text-small font-600-bold">({{ trans('public.finished') }})</span>
                                                    @endif
                                                    @break
                                                    @case(\App\Models\Webinar::$isDraft)
                                                    <span class="text-dark">{{ trans('admin/main.is_draft') }}</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$pending)
                                                    <span class="text-warning">{{ trans('admin/main.waiting') }}</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$inactive)
                                                    <span class="text-danger">{{ trans('public.rejected') }}</span>
                                                    @break
                                                @endswitch
                                            </div>
                                        </a>
                                    @endforeach

                                    <a href="{{ getAdminPanelUrl() }}/webinars?type=webinar" class="ticket-item ticket-more">
                                        {{trans('admin/main.view_all')}} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan

            @can('admin_general_dashboard_recent_courses')
                @if(!empty($recentCourses))
                    <div class="col-md-4">
                        <div class="card card-hero" style="height: 96%">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h5>{{trans('admin/main.recent_courses')}}</h5>
                                <div class="card-description">{{ $recentCourses['pendingReviews'] }} {{trans('admin/main.pending_review')}}</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">


                                    @foreach($recentCourses['courses'] as $course)
                                        <a href="{{ getAdminPanelUrl() }}/webinars/{{ $course->id }}/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $course->title }}</h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div>{{ $course->teacher->full_name }}</div>
                                                <div class="bullet"></div>
                                                @switch($course->status)
                                                    @case(\App\Models\Webinar::$active)
                                                    <span class="text-success">{{ trans('admin/main.publish') }}</span>
                                                    @if($course->isProgressing())
                                                        <div class="text-warning text-small font-600-bold">({{  trans('webinars.in_progress') }})</div>
                                                    @elseif($course->start_date > time())
                                                        <div class="text-danger text-small font-600-bold">({{  trans('admin/main.not_conducted') }})</div>
                                                    @else
                                                        <span class="text-success text-small font-600-bold">({{ trans('public.finished') }})</span>
                                                    @endif
                                                    @break
                                                    @case(\App\Models\Webinar::$isDraft)
                                                    <span class="text-dark">{{ trans('admin/main.is_draft') }}</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$pending)
                                                    <span class="text-warning">{{ trans('admin/main.waiting') }}</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$inactive)
                                                    <span class="text-danger">{{ trans('public.rejected') }}</span>
                                                    @break
                                                @endswitch
                                            </div>
                                        </a>
                                    @endforeach


                                    <a href="{{ getAdminPanelUrl() }}/webinars?type=course" class="ticket-item ticket-more">
                                        {{trans('admin/main.view_all')}} <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        </div>

        @can('admin_general_dashboard_users_statistics_chart')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('admin/main.new_registration_statistics')}}</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    {{--<a href="#" class="btn">Views
                                    </a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="position-relative">
                                        <canvas id="usersStatisticsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="/assets/admin/vendor/owl.carousel/owl.carousel.min.js"></script>

    <script src="/assets/admin/js/dashboard.min.js"></script>

    <!-- JavaScript for map -->
    <script type="text/javascript">
        document.onreadystatechange = function () {
            if (document.readyState !== "complete") {
                document.querySelector("#loader").style.visibility = "visible";
            } else {
                document.querySelector("#loader").style.display = "none";
            }
        };

        const minZoomLevel = 5;
        const map = L.map('map', {
            center: [-0.7893, 113.9213],
            zoom: minZoomLevel,
            minZoom: minZoomLevel,
            // maxZoom: 19,
            attributionControl: false,
        });

        // Tambahkan tile layer
        L.tileLayer('', {
            attribution: false
        }).addTo(map);

        var labelControl = L.control({position: 'bottomright'});
        labelControl.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'label');
            div.innerHTML = 'Sumber: BPKP e-LMS';
            return div;
        };
        labelControl.addTo(map);

        const maxBounds = L.latLngBounds(L.latLng(-11.00828, 94.771965), L.latLng(6.27499, 141.019547));
        map.setMaxBounds(maxBounds);
        map.fitBounds(maxBounds);

        <?php
        if (!empty($user['role_name']) && $user['role_name'] === 'dpw') {
        ?>
        
        const info = L.control();
        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };
        info.update = function (props) {
            // console.log(props)
            var contents = '';
            if(props){
                if(props.isKabkota){
                    contents = `<b>Area: ${props.kabupaten_name}</b>
                    <p m-0>Jumlah DPW: ${props.dpw_count}</p>`
                }else{
                    contents = `<b>${props.propinsi_name}</b>`
                }
            }else{
                contents = '<div class="desc-maps">Pilih Wilayah yang ingin dilihat</div>';
            }
            this._div.innerHTML = `<label class="title-maps">Wilayah Kabkot di <?= $user['provinceName'] ?> </label><br>
                                    <div class="info-content">${contents}</div>`;
        };
        info.addTo(map);

        <?php
        } else {
        ?>
            const info = L.control();
            info.onAdd = function (map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            };
            info.update = function (props) {
                // console.log(props)
                var contents = '';
                if(props){
                    if(props.isKabkota){
                        contents = `<b>Area: ${props.kabupaten_name}</b>
                        <p m-0>Jumlah DPW: ${props.dpw_count}</p>`
                    }else{
                        contents = `<b>${props.propinsi_name}</b>`
                    }
                }else{
                    contents = '<div class="desc-maps">Pilih Wilayah yang ingin dilihat</div>';
                }
                this._div.innerHTML = `<label class="title-maps">Wilayah Provinsi</label><br>
                                        <div class="info-content">${contents}</div>`;
            };
            info.addTo(map);
        <?php
        }
        ?>

        var propinsiLayer;

        function parseDataJson(d, isKabkota){
            var result = {
                type: "FeatureCollection",
                name: "gadm41_IDN_1",
                crs: {
                    type: "name",
                    properties: {
                        name: "urn:ogc:def:crs:OGC:1.3:CRS84"
                    }
                },
                features: []
            }
            d.map((i) => {
                let feature = {
                    "id": i.province_code,
                    "type": "Feature",
                    "properties": {
                        ...i, 
                        isKabkota: isKabkota
                    },
                    "geometry":{
                        "type":"MultiPolygon",
                        "coordinates": []
                    }
                }
                let multipolygonData = i.shape;
                var polygons = multipolygonData.split(")), ((");
                polygons.forEach(polygon => {
                    var c = polygon
                    .replace("MULTIPOLYGON(((", "")
                    .replace(")))", "")
                    .split(", ")
                    .map((coords) => {
                        var lngLat = coords.split(" ");
                        var lng = parseFloat(lngLat[0]);
                        var lat = parseFloat(lngLat[1]);
                        if (!isNaN(lng) && !isNaN(lat)) {
                            return [lng, lat];
                        } else {
                            return null;
                        }
                    })
                    .filter((coords) => coords !== null);

                    if (c.length > 0) {
                        feature.geometry.coordinates.push([c]);
                    }

                });
                result.features.push(feature);
            })

            return result;
        }


        <?php
        if (!empty($user['role_name']) && $user['role_name'] === 'dpw') {
        ?>
        getdataKabkot(<?= $user['province_code'] ?>);
        <?php
        } else {
        ?>
            getdata();
        <?php
        }
        ?>

        var propinsiLabel;

        function PropinsiLabel(propinsiName, latlng) {
            var label = L.marker(latlng, { 
                icon: L.divIcon({
                    className: 'label-geojson',
                    html: propinsiName
                })
            });
            label.addTo(map);
            $('.label-geojson').css('pointer-events', 'none');
        }

        function KabkotLabel(kabkotaName, latlng) {
            var label = L.marker(latlng, {
                icon: L.divIcon({
                    className: 'label-geojson',
                    html: kabkotaName
                })
            });
            label.addTo(map);
            $('.label-geojson').css('pointer-events', 'none');
        }

        function getUserData(callback) {
            $.ajax({
                url: '/admin/get-user-data',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Province Code:', response.province_code);
                    console.log('Role Name:', response.role_name);
                    callback(response);
                },
                error: function(xhr, status, error) {
                    console.error(status, error);
                    callback(null);
                }
            });
        }

        function getdataKabkot(id = null){
            var url = '/admin/getKabkotaGeoJSON/' + id;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) 
                    if(id){
                        $('#map').removeClass('mt-25');
                        var backMapPlace = document.querySelector('.back-map-place');
                        if (backMapPlace) {
                            backMapPlace.remove();
                        }
                    }else{
                        $('.back-map-place').addClass('d-none');
                    }
                    let datanya = parseDataJson(data, id ? true : false)
                    propinsiLayer = L.geoJSON(datanya, {
                        style: function (feature) {
                            return {
                                fillColor: '#b6001d',
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                dashArray: '',
                                fillOpacity: 0.7
                            };
                        },
                        onEachFeature: function (feature, layer) {
                            if (!feature.properties.isPropinsi) {
                                var kabkotaLabel = KabkotLabel(feature.properties.kabupaten_name, layer.getBounds().getCenter());
                                layer.bindTooltip(function (layer) {
                                    if (layer.feature.properties.isKabkota) {
                                        return `
                                            <b>${layer.feature.properties.kabupaten_name}</b>
                                            <div class="mt-10"></div>
                                            Jumlah Anggota Biasa: ${layer.feature.properties.anggota_biasa_count}
                                            <br>
                                            Jumlah Anggota Luar Biasa: ${layer.feature.properties.anggota_luar_biasa_count}
                                            <br>
                                            Jumlah Anggota Kehormatan: ${layer.feature.properties.angggota_kehormatan_count}
                                        `;
                                    } else {
                                        return '';
                                    }
                                });
                            }
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                                click: (e) => {
                                    if (feature.properties.isKabkota) {
                                        return;
                                    }
                                    setNewMap(e);
                                    removeLabel();
                                },
                            });
                        }
                    }).addTo(map);
            
                    // map.fitBounds(propinsiLayer.getBounds());
                    var kabkotBounds = propinsiLayer.getBounds();
                    map.fitBounds(kabkotBounds);
                },
                error: function (xhr, status, error) {
                    console.error(status, error);
                }
            });
        }

        function getdata(id = null){
            if(id){
                var url = '/admin/getKabkotaGeoJSON/' + id;
            }else{
                var url = '/admin/getPropinsiGeoJSON/';
            }

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if(id){
                        $('.back-map-place').removeClass('d-none');
                    }else{
                        $('.back-map-place').addClass('d-none');
                    }
                    let datanya = parseDataJson(data, id ? true : false)
                    propinsiLayer = L.geoJSON(datanya, {
                        style: function (feature) {
                            return {
                                fillColor: '#b6001d',
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                dashArray: '',
                                fillOpacity: 0.7
                            };
                        },
                        onEachFeature: function (feature, layer) {
                            if(!feature.properties.isKabkota){
                                var propinsiLabel = PropinsiLabel(feature.properties.propinsi_name, layer.getBounds().getCenter());
                                // layer.bindPopup(feature.properties.alias);
                            }
                            else if (!feature.properties.isPropinsi) {
                                var kabkotaLabel = KabkotLabel(feature.properties.kabupaten_name, layer.getBounds().getCenter());
                                layer.bindTooltip(function (layer) {
                                    if (layer.feature.properties.isKabkota) {
                                        return `
                                            <b>${layer.feature.properties.kabupaten_name}</b>
                                            <div class="mt-10"></div>
                                            Jumlah Anggota Biasa: ${layer.feature.properties.anggota_biasa_count}
                                            <br>
                                            Jumlah Anggota Luar Biasa: ${layer.feature.properties.anggota_luar_biasa_count}
                                            <br>
                                            Jumlah Anggota Kehormatan: ${layer.feature.properties.angggota_kehormatan_count}
                                        `;
                                    } else {
                                        return '';
                                    }
                                });
                            }
                            layer.on({
                                mouseover: highlightFeature,
                                mouseout: resetHighlight,
                                click: (e) => {
                                    if (feature.properties.isKabkota) {
                                        return;
                                    }
                                    setNewMap(e);
                                    removeLabel();
                                },
                            });
                        }
                    }).addTo(map);
            
                    // map.fitBounds(propinsiLayer.getBounds());
                },
                error: function (xhr, status, error) {
                    console.error(status, error);
                }
            });
        }

        function removeLabel() {
            $('.label-geojson').remove();
        }

        function showKabkotaLabel(kabkotaName) {
            removeLabel(); 
            addKabkotaLabel(kabkotaName); 
        }

        function addKabkotaLabel(kabkotaName) {
            var label = $('<div class="label-geojson">').text(kabkotaName);
            $('#map').append(label); 
        }

        $('#backMap').on('click', function(){
            map.removeLayer(propinsiLayer);
            removeLabel();
            getdata();
            map.fitBounds(maxBounds);
        });

        function setNewMap(e){
            var id = e.sourceTarget.feature.id;
            map.removeLayer(propinsiLayer);
            
            getdata(id);
            zoomToFeature(e);
        }

        function highlightFeature(e) {
            const layer = e.target;
            layer.setStyle({
                fillColor: '#d60606',
                weight: 2.5,
                color: '#fff',
                dashArray: '',
                fillOpacity: 0.8
            });
            layer.bringToFront();
            info.update(layer.feature.properties);
        }

        function resetHighlight(e) {
            propinsiLayer.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

    </script>

    <script>
        (function ($) {
            "use strict";

            @if(!empty($getMonthAndYearSalesChart))
            makeStatisticsChart('saleStatisticsChart', saleStatisticsChart, 'Sale', @json($getMonthAndYearSalesChart['labels']),@json($getMonthAndYearSalesChart['data']));
            @endif

            @if(!empty($usersStatisticsChart))
            makeStatisticsChart('usersStatisticsChart', usersStatisticsChart, 'Users', @json($usersStatisticsChart['labels']),@json($usersStatisticsChart['data']));
            @endif

        })(jQuery)
    </script>
@endpush
