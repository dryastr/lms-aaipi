@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/blog.css">
@endpush

@section('content')
    <section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('blog') }}" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ $pageTitle }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ $pageTitle }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-10 mt-md-40">
        <div class="row">
            @unless(request()->has('search'))
            <div class="col-12 col-lg-12">
            @endunless
                @if(request()->has('search'))
                <div class="col-12 col-md-8">
                @endif
                <div class="row">
                    @if($blog->isEmpty())
                    <div class="col-12">
                        <div class="text-center font-20 font-weight-bold text-dark-blue mt-50">
                            {{ trans('public.no_search_results') }}
                        </div>
                    </div>
                    @else
                        @foreach($blog as $post)
                            @unless(request()->has('search'))
                                <div class="col-12 col-md-4 col-lg-4">
                            @endunless
                            @if(request()->has('search'))
                                <div class="col-12 col-md-4 col-lg-6">
                            @endif
                            <div class="mt-30">
                                @include('web.default.blog.grid-list',['post' => $post])
                            </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @if(request()->has('search'))
                <div class="col-12 col-lg-4">
                    <div class="rounded-lg shadow-sm mt-35 search-input bg-white px-20 py-25 flex-grow-1">
                        <form action="/blog" method="get">
                            <div class="form-group d-flex align-items-center m-0">
                                <input type="text" name="search" class="form-control input-search-blog" value="{{ request()->get('search') }}" placeholder="{{ trans('home.blog_search_placeholder') }}"/>
                                <button type="submit" class="btn btn-search-blog">
                                    <i data-feather="search" width="20" height="20" class="">{{ trans('home.find') }}</i>
                                </button>
                            </div>
                            <div class="w-full mt-20">
                           @if ($previousUrl)
                                <a href="{{ $previousUrl }}" class="btn btn-primary w-100">Kembali</a>
                            @endif
                            </div>
                    </div>

                    {{-- recent_posts --}}
                    <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                        <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('site.popular_posts') }}</h3>

                        <div class="pt-15">

                            @foreach($popularPosts as $popularPost)
                                <div class="popular-post d-flex align-items-start mt-20">
                                    <div class="popular-post-image rounded">
                                        <img src="{{ $popularPost->image }}" class="img-cover rounded" alt="{{ $popularPost->title }}">
                                    </div>
                                    <div class="popular-post-content d-flex flex-column ml-10">
                                        <a href="{{ $popularPost->getUrl() }}">
                                            <h3 class="font-14 text-dark-blue">{{ truncate($popularPost->title,40) }}</h3>
                                        </a>
                                        <span class="mt-auto font-12 text-gray">
                                            {{ \Carbon\Carbon::parse($popularPost->created_at)->locale('id')->translatedFormat('j F Y | H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>

                    {{-- categories --}}
                    <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                        <h3 class="category-filter-title font-16 font-weight-bold text-dark-blue">{{ trans('categories.categories') }}</h3>

                        <div class="pt-15">
                            @foreach($blogCategories as $dataName)
                            <div class="d-flex align-items-start justify-content-left mt-20">
                                <div class="custom-control custom-checkbox desible">
                                    <input type="checkbox" name="searchkategori[]"
                                        id="filterType{{ $dataName->id }}" onchange="this.form.submit()"
                                        value="{{ $dataName->id }}"
                                        @if (in_array($dataName->id, (array)request()->get('searchkategori', []))) checked @endif
                                        class="custom-control-input">
                                    <label class="custom-control-label"
                                        for="filterType{{ $dataName->id }}"></label>
                                </div>
                                <label class="d-flex align-items-center cursor-pointer @if (in_array($dataName->id, (array)request()->get('searchkategori', []))) text-primary @endif"
                                    for="filterType{{ $dataName->id }}">
                                    @if (in_array($dataName->id, (array)request()->get('searchkategori', [])))
                                        <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                    @endif
                                    {{ $dataName->title }}
                                </label>
                            </div>
                        @endforeach
                        
                        </div>
                    </div>

                    <div class="mt-30 px-20 py-15 rounded-sm shadow-lg border border-gray300">
                        <h3 class="category-filter-title font-20 font-weight-bold">{{ trans('public.core_kompetency') }}</h3>
    
                        {{-- <form action="/blog" method="post"> --}}
                            <div class="mt-20 d-flex  flex-wrap">
                            
                                @foreach($categories as $category)
                                    @if(!empty($category->subCategories) and count($category->subCategories))
                                        @foreach($category->subCategories as $subCategory)
                                        {{-- {{dd($subCategory)}} --}}
                                            <div class="checkbox-button bordered-200 mt-5 mr-15">
                                                <input type="checkbox" name="categories[]" id="checkbox{{ $subCategory->id }}" value="{{ $subCategory->slug }}" @if(in_array($subCategory->slug,request()->get('categories',[]))) checked="checked" @endif>
                                                <label for="checkbox{{ $subCategory->id }}">{{ $subCategory->title }}</label>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="checkbox-button bordered-200 mr-20">
                                            <input type="checkbox" name="categories[]" id="checkbox{{ $category->id }}" value="{{ $category->id }}" @if(in_array($category->id,request()->get('categories',[]))) checked="checked" @endif>
                                            <label for="checkbox{{ $category->id }}">{{ $category->title }}</label>
                                        </div>
                                    @endif
                                @endforeach
    
                            </div>
                            <button type="submit" class="btn btn-primary w-100">filter</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </form>

        <div class="mt-20 mt-md-50 pt-30">
            {{ $blog->appends(request()->input())->links('vendor.pagination.panel') }}
        </div>

    </section>
@endsection
