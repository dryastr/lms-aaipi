@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">
@endpush

{{-- {{dd(auth()->user()->is_member_aaipi)}} --}}
@section('content')
    <section class="site-top-banner site-top-banner-custom search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('categories') }}" class="img-cover" alt="" />

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-black font-30 mb-15">{{ $pageTitle }}</h1>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                <li class="breadcrumb-item font-weight-bold" aria-current="page">Daftar Pembelajaran</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-30">

        <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
            <form action="/classes" method="get" id="filtersForm">

                @include('web.default.pages.includes.top_filters')

                <div class="row mt-20">
                    <div class="col-12 col-lg-4">
                        <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">

                            <div class="">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Cari Disini</h3>

                                <div class="pt-10 mt-20 navbar-search position-relative">
                                    <input class="form-control mr-5 rounded" type="text" name="search"
                                        placeholder="Search..." aria-label="Search" value="{{ request()->input('search') }}">
                                    <button type="submit"
                                        class="btn-transparent d-flex align-items-center justify-content-center search-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search mr-10">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </div>
                                <button id="resetButton" style="display: none;" class="btn btn-primary mt-20 w-100  font-14 borde">
                                    <a href="{{ route('classes.index') }}" style="width:100%" class="text-white text-decoration-none font-11">Reset Pencarian</a>
                                </button>
                            </div>

                            <div class="mt-25 pt-25">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('public.sort_by') }}</h3>
                                <div class="pt-10 mt-20 position-relative" id="topFilters">
                                    <div class="align-items-center">
                                        <div class="d-flex align-items-center">
                                            <select name="sort" class="form-control font-14 w-100">
                                                <option disabled selected>{{ trans('public.sort_by') }}</option>
                                                <option value="">{{ trans('public.all') }}</option>
                                                <option value="newest" @if(request()->get('sort', null) == 'newest') selected="selected" @endif>{{ trans('public.newest') }}</option>
                                                <option value="expensive" @if(request()->get('sort', null) == 'expensive') selected="selected" @endif>{{ trans('public.expensive') }}</option>
                                                <option value="inexpensive" @if(request()->get('sort', null) == 'inexpensive') selected="selected" @endif>{{ trans('public.inexpensive') }}</option>
                                                <option value="bestsellers" @if(request()->get('sort', null) == 'bestsellers') selected="selected" @endif>{{ trans('public.bestsellers') }}</option>
                                                <option value="best_rates" @if(request()->get('sort', null) == 'best_rates') selected="selected" @endif>{{ trans('public.best_rates') }}</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="pt-10 mt-20">
                                <ul class="side-menu">
                                    @foreach ($category as $cat)
                                    <li class="border">
                                        <a href="{{ route('classes.index', ['category_slug' => $cat->category->slug]) }}" class="d-flex justify-content-between">
                                            <span>{{ $cat->category->slug }}</span>
                                            <span></span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                            

                            <div class="mt-10 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    Pilih Pencarian</h3>

                                <div class="pt-10">
                                    @foreach (['upcoming', 'free', 'discount', 'downloadable'] as $Pilihpencarian)
                                        <div class="d-flex align-items-start justify-content-left mt-20">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="pilihpencarian[]" id="filterLanguage{{ $Pilihpencarian }}"
                                                    value="{{ $Pilihpencarian }}"
                                                    @if (in_array($Pilihpencarian, request()->get('pilihpencarian', []))) checked="checked" @endif
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="filterLanguage{{ $Pilihpencarian }}"></label>
                                            </div>
                                            <label class="cursor-pointer" for="filterLanguage{{ $Pilihpencarian }}">
                                                @if ($Pilihpencarian == 'bundle')
                                                    {{ trans('update.bundle') }}
                                                @else
                                                    {{ trans('panel.' . $Pilihpencarian) }}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    Pilih Pencarian</h3>
                                    <div id="topFilters">
                                            <div class="pt-10 mt-20">
                                                <div class="mr-0 mr-md-20 my-20 my-md-0">
                                                    <label class="d-flex mb-0 mr-10 cursor-pointer @if(request()->get('upcoming', null) == 'on') text-primary @endif" for="upcoming">
                                                        @if(request()->get('upcoming', null) == 'on')
                                                            <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                                        @endif
                                                        {{ trans('panel.upcoming') }}
                                                    </label>
                                                </label>
                                                    <div class="custom-control custom-switch desible">
                                                        <input type="checkbox" name="upcoming" class="custom-control-input" id="upcoming" @if(request()->get('upcoming', null) == 'on') checked="checked" @endif>
                                                        <label class="custom-control-label" for="upcoming"></label>
                                                    </div>
                                                </div>
                                    
                                                <div class="d-flex mt-10">
                                                    <label class="d-flex mb-0 mr-10 cursor-pointer @if(request()->get('free', null) == 'on')  text-primary @endif" for="free">
                                                    @if (request()->get('free', null) == 'on')
                                                        <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                                    @endif
                                                    {{ trans('public.free') }}
                                                    </label>
                                                    <div class="custom-control custom-switch desible">
                                                        <input type="checkbox" name="free" class="custom-control-input" id="free" @if(request()->get('free', null) == 'on')  checked="checked"  @endif>
                                                        <label class="custom-control-label" for="free"></label>
                                                    </div>
                                                </div>
                                    
                                                <div class="d-flex mt-10">
                                                    <label class="d-flex mb-0 mr-10 cursor-pointer @if(request()->get('discount', null) == 'on') text-primary @endif"" for="discount">
                                                    @if (request()->get('discount', null) == 'on')
                                                        <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                                    @endif
                                                    {{ trans('public.discount') }}
                                                    </label>
                                                    <div class="custom-control custom-switch desible">
                                                        <input type="checkbox" name="discount" class="custom-control-input" id="discount" @if(request()->get('discount', null) == 'on') checked="checked" @endif>
                                                        <label class="custom-control-label" for="discount"></label>
                                                    </div>
                                                </div>
                                    
                                                <div class="d-flex mt-10">
                                                    <label class="d-flex mb-0 mr-10 cursor-pointer @if(request()->get('downloadable', null) == 'on') text-primary @endif" for="download">
                                                    @if (request()->get('downloadable', null) == 'on')
                                                        <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                                    @endif
                                                    {{ trans('home.download') }}
                                                    </label>
                                                    <div class="custom-control custom-switch desible">
                                                        <input type="checkbox" name="downloadable" class="custom-control-input" id="download" @if(request()->get('downloadable', null) == 'on') checked="checked" @endif>
                                                        <label class="custom-control-label" for="download"></label>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                    
                            </div> --}}

                            {{-- <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    Core Kompetensi</h3>

                                    <div class="pt-10 mt-20">
                                        <ul class="side-menu">
                                            @foreach ($category as $cat)
                                            <li class="border">
                                                <a href="{{ route('classes.index', ['category_slug' => $cat->category->slug]) }}" class="d-flex justify-content-between">
                                                    <span>{{ $cat->category->slug }}</span>
                                                    <span></span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                            </div> --}}
                            
                    
                            <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    Core Kompetensi
                                </h3>
                                <div class="pt-10">
                                    @foreach ($category as $cat)
                                        <div class="d-flex align-items-start justify-content-left mt-20">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="corekompetensi[]" id="filterLanguage{{ $cat->id }}"
                                                    value={{ $cat->category_id}}
                                                    @if (in_array($cat->category_id, request()->get('corekompetensi', []))) checked="checked" @endif
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="filterLanguage{{ $cat->id }}">{{ $cat->category->slug }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            


                            <div class="mt-10 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    {{ trans('public.type') }}</h3>

                                <div class="pt-10">
                                    @foreach (['bundle', 'webinar', 'course', 'text_lesson'] as $typeOption)
                                        <div class="d-flex align-items-start justify-content-left mt-20">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="type[]" id="filterLanguage{{ $typeOption }}"
                                                    value="{{ $typeOption }}"
                                                    @if (in_array($typeOption, request()->get('type', []))) checked="checked" @endif
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="filterLanguage{{ $typeOption }}"></label>
                                            </div>
                                            <label class="cursor-pointer" for="filterLanguage{{ $typeOption }}">
                                                @if ($typeOption == 'bundle')
                                                    {{ trans('update.bundle') }}
                                                @else
                                                    {{ trans('webinars.' . $typeOption) }}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    {{ trans('panel.cross_competency') }}
                                </h3>
                                <div class="pt-10">
                                    @foreach ($crossCompetencies->where('types', 'crosscom') as $typeCrosscom)
                                        <div class="d-flex align-items-start justify-content-left mt-20">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="crosscom[]" id="filterLanguage{{ $typeCrosscom->id }}"
                                                    value="crosscom"
                                                    @if (in_array('crosscom', request()->get('crosscom', []))) checked="checked" @endif
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="filterLanguage{{ $typeCrosscom->id }}">{{ $typeCrosscom->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            

                            <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    {{ trans('panel.thematic') }}</h3>
                                    <div class="pt-10">
                                        @foreach ($crossCompetencies->where('types', 'thematic') as $typeThematic)
                                            <div class="d-flex align-items-start justify-content-left mt-20">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="thematic[]" id="filterLanguage{{ $typeThematic }}"
                                                        value="thematic"
                                                        @if (in_array('thematic', request()->get('thematic', []))) checked="checked" @endif
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="filterLanguage{{ $typeThematic }}"></label>
                                                </div>
                                                <label class="cursor-pointer" for="filterLanguage{{ $typeThematic }}">
                                                        {{  $typeThematic['name'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <button type="submit"
                            class="btn btn-sm btn-primary btn-block mt-30">{{ trans('site.filter_items') }}</button>
                        </div> 
                           
                   </div>

                    @php
                        $categorySlug = request()->input('category_slug');
                        $search = request()->input('search');
                        // $selectedThemes = collect(request()->input('thematic'))->map(function($themeId) use ($crossCompetencies) {
                        //     return $crossCompetencies->find($themeId)->name;
                        // })->implode(', ');
                    @endphp

                    <div class="col-12 col-lg-8">
                        @if($noResults)
                            @if(request()->get('thematic', []))
                            <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                <p>{{ trans('public.data_not_found') }} {{ trans('admin/main.thematic') }}</p>
                            </div>
                            @elseif(request()->get('crosscom', []))
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_not_found') }}{{ trans('admin/main.cross_competency') }}</p>
                                </div>
                                @elseif(request()->has('upcoming'))
                                    <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                        <p>{{ trans('public.data_search_not_found_upcomming') }}</p>
                                    </div>
                                @elseif(request()->has('free'))
                                    <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                        <p>{{ trans('public.data_search_not_found_free') }}</p>
                                    </div>
                                @elseif(request()->has('discount'))
                                    <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                        <p>{{ trans('public.data_search_not_found_discount') }}</p>
                                    </div>
                                @elseif(request()->has('downloadable'))
                                    <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                        <p>{{ trans('public.data_search_not_found_downloadable') }}</p>
                                    </div>
                            @elseif(request()->has('search'))
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_search_not_found') }}{{ $search }}</p>
                                </div>
                            @else
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_not_found') }}{{ $categorySlug ? $categorySlug : 'yang dipilih' }}</p>
                                </div>
                            @endif
                        @else
                            @if (empty(request()->get('card')) or request()->get('card') == 'grid')
                                <div class="row">
                                    @foreach ($webinars as $webinar)
                                        <div class="col-12 col-lg-6 mt-20">
                                            @include('web.default.includes.webinar.grid-card', [
                                                'webinar' => $webinar, 
                                            ])
                                        </div>
                                    @endforeach
                                </div>
                            @elseif(!empty(request()->get('card')) and request()->get('card') == 'list')
                                @foreach ($webinars as $webinar)
                                    @include('web.default.includes.webinar.list-card', ['webinar' => $webinar])
                                @endforeach
                            @endif
                        @endif
                        </div>
                    </div>
            </form>
            <div class="mt-50 pt-30">
                {{ $webinars->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        </section>
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script src="/assets/default/js/parts/categories.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            
            var urlParams = new URLSearchParams(window.location.search);
            
            
            if (urlParams.has('search')) {
            
                $('#resetButton').show();
            } else {
             
                $('#resetButton').hide();
            }

        });
    </script>
    

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush