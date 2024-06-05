@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/blog.css">
@endpush

@section('content')
    <section class="site-top-banner site-top-banner-custom search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('categories') }}" class="img-cover" alt=""/>
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-black font-30 mb-15">{{ trans('auth.resources') }}</h1>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex justify-content-center">
                                <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('auth.daftar_resources') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-30">

        <section class="mt-lg-10 pt-lg-20 mt-md-20 pt-md-20">
            <form action="/resources" method="get" id="filtersForm">
                <div class="row mt-20">
                    <div class="col-12 col-lg-4">
                        <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">

                            <div class="">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Cari Disini</h3>

                                <div class="pt-10 mt-20 navbar-search position-relative">
                                    <input class="form-control mr-5 rounded" type="text" name="search" placeholder="Search..." aria-label="Search" value="{{ request()->input('search') }}">

                                    <button type="submit" class="btn-transparent d-flex align-items-center justify-content-center search-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search mr-10"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </button>
                                </div>
                            </div>
                            <button id="resetButton" style="display: none;" class="btn btn-primary mt-20 w-100  font-14 borde">
                                <a href="{{ route('resources.index') }}" style="width:100%" class="text-white text-decoration-none font-11">Reset Pencarian</a>
                            </button>
                            <div class="mt-25 pt-25">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('public.sort_by') }}</h3>
                                <div class="pt-10 mt-20 position-relative" id="topFilters">
                                    <div class="align-items-center">
                                        <div class="d-flex align-items-center">
                                            <select name="sort" class="form-control font-14 w-100">
                                                <option disabled selected>{{ trans('public.sort_by') }}</option>
                                                <option value="">{{ trans('public.all') }}</option>
                                                <option value="newest" @if(request()->get('sort', null) == 'newest') selected="selected" @endif>{{ trans('public.newest') }}</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mt-25 pt-25">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Core Kompetensi</h3>

                                <div class="pt-10 mt-20">
                                    <ul class="side-menu">
                                        @foreach ($category as $category)
                                        <li class="border">
                                            <a href="{{ route('resources.index', ['category_slug' => $category->category->slug]) }}" class="d-flex justify-content-between">
                                                <span>{{ $category->category->slug }}</span>
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

                            {{-- <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">
                                    {{ trans('panel.cross_competency') }}</h3>
                                <div class="pt-10">
                                    <div class="mt-20">
                                        @foreach ($crossCompetencies->where('types', 'crosscom') as $dataName)
                                            <div class="d-flex align-items-start justify-content-left mt-20">
                                                <div class="custom-control custom-checkbox desible">
                                                    <input type="checkbox" name="crosscom[]"
                                                        id="filterType{{ $dataName->id }}" onchange="this.form.submit()"
                                                        value="{{ $dataName->id }}"
                                                        @if (in_array($dataName->id, request()->get('crosscom', []))) checked="checked" @endif
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="filterType{{ $dataName->id }}"></label>
                                                </div>
                                                <label class="cursor-pointer"
                                                    for="filterType{{ $dataName->id }}">{{ $dataName->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}

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

                            {{-- <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Tematik</h3>
                                <div class="pt-10">
                                    <div class="mt-20">
                                        @foreach ($crossCompetencies->where('types', 'thematic') as $dataName)
                                            <div class="d-flex align-items-start justify-content-left mt-20">
                                                <div class="custom-control custom-checkbox desible">
                                                    <input type="checkbox" name="thematic[]"
                                                        id="filterType{{ $dataName->id }}" onchange="this.form.submit()"
                                                        value="{{ $dataName->id }}"
                                                        @if (in_array($dataName->id, request()->get('thematic', []))) checked="checked" @endif
                                                        class="custom-control-input thematic-checkbox">
                                                    <label class="custom-control-label"
                                                        for="filterType{{ $dataName->id }}"></label>
                                                </div>
                                                <label class="cursor-pointer thematic-label"
                                                    for="filterType{{ $dataName->id }}">{{ $dataName->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
                            <button type="submit"
                            class="btn btn-sm btn-primary btn-block mt-30">{{ trans('site.filter_items') }}</button>
                        </div>
                    </div>

                    @php
                        $categorySlug = request()->input('category_slug');

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
                            @elseif(request()->has('crosscom'))
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_not_found') }}{{ trans('admin/main.cross_competency') }}</p>
                                </div>
                            
                            @elseif(request()->has('search'))
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_search_not_found') }}"{{ request()->input("search") }}"</p>
                                </div>
                            @else
                                <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                                    <p>{{ trans('public.data_not_found') }}{{ $categorySlug ? $categorySlug : 'yang dipilih' }}</p>
                                </div>
                            @endif                            
                        @else
                            @if(empty(request()->get('card')) or request()->get('card') == 'grid')
                                <div class="row">
                                    @foreach($resources as $resource)
                                        <div class="col-12 col-lg-6 mt-20">
                                            @include('web.default.includes.resources.grid-card',['webinar' => $resource])
                                        </div>
                                    @endforeach
                                </div>

                            @elseif(!empty(request()->get('card')) and request()->get('card') == 'list')

                                @foreach($resources as $resource)
                                    @include('web.default.includes.resources.list-card',['webinar' => $resource])
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>

            </form>
            <div class="mt-50 pt-30">
                {{ $resources->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        </section>
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/default/js/parts/categories.min.js"></script>
    <script>
        // Menangani perubahan pada checkbox
        var checkboxes = document.querySelectorAll('.thematic-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Mengaktifkan tombol ketika checkbox dicentang
                    this.nextElementSibling.classList.add('active');
                } else {
                    // Menonaktifkan tombol ketika checkbox tidak dicentang
                    this.nextElementSibling.classList.remove('active');
                }
            });
        });
    </script>
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
      
@endpush
