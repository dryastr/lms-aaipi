@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-brands/css/uicons-brands.css'>
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/blog.css">
@endpush

@section('content')
    <section class="site-top-banner site-top-banner-custom site-top-banner-position search-top-banner opacity-04 position-relative">
        <img src="{{ getPageBackgroundSettings('blog') }}" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-dark-blue font-30 mb-15">{{ trans('site.detail_blog') }}</h1>
                        <div class="d-flex align-items-center justify-content-center mt-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item text-dark-blue"><a href="/" class=" text-dark-blue">{{ getGeneralSettings('site_name') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue"><a href="/blog" class=" text-dark-blue">{{ trans('public.blog') }}</a></li>
                                    <li class="breadcrumb-item text-dark-blue font-weight-bold" aria-current="page">{{ trans('site.detail_blog') }}</li>
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
            <div class="col-12 col-lg-8">
                <div class="post-show mt-30">

                    <div class="post-img pb-15">
                        <img src="{{ $post->image }}" alt="">
                        <div class="d-flex flex-column flex-sm-row align-items-center align-sm-items-start">
                            @if(!empty($post->author))
                            <span class="mt-10 mt-md-20 mr-25 font-16 font-weight-500 text-dark-yellow span-blog">
                                    @if($post->author->isTeacher())
                                        <a href="{{ $post->author->getProfileUrl() }}" target="_blank" class="text-dark-yellow">{{ $post->author->full_name }}</a>
                                    @elseif(!empty($post->author->full_name))
                                        <span class="text-dark-yellow"><img src="{{ asset('assets/aaipi/img/blog/user.svg') }}" alt="User">{{ $post->author->full_name }}</span>
                                    @endif
                            </span>
                            @endif
    
                            <span class="d-flex mt-10 mt-md-20 mr-25 font-16 font-weight-500 text-dark-yellow span-blog">
                                <img src="{{ asset('assets/aaipi/img/blog/clock.svg') }}" alt="User">
                                {{-- {{ dateTimeFormat($post->created_at, 'j M Y') }} --}}
                                {{-- {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j M Y') }} --}}
                                {{ \Carbon\Carbon::parse($post->created_at)->locale('id')->translatedFormat('j F Y | H:i') }}
                            </span>

                            <span class="d-flex mt-10 mt-md-20 mr-25 font-16 font-weight-500 text-dark-yellow span-blog">
                                <img src="{{ asset('assets/aaipi/img/blog/comment.svg') }}" alt="User">
                                {{ $post->comments_count }}
                            </span>

                            <span class="d-flex mt-10 mt-md-20 mr-25 font-16 font-weight-500 text-dark-yellow span-blog">
                                <img src="{{ asset('assets/aaipi/img/blog/eye.svg') }}" alt="User">
                                {{ $post->visit_count }}
                            </span>
                        </div>
                        <h1 class="font-30 text-blue-dark font-weight-bold">{{ $post->title }}</h1>
                    </div>
                    <div class="p-0">
                        {!! nl2br($post->content) !!}
                    </div>
                    <div class="d-flex p-0 mt-30">
                        <div class="btn d-flex blog-socials blog-social-facebook rounded mr-15">
                            <a href="{{ $post->getShareLink('facebook') }}" class="d-flex share-facebook-btn" onclick="shareFacebook('{{ $post->slug }}')" target="_blank">
                                <img src="{{ asset('assets/aaipi/img/blog/socials/facebook.svg') }}" alt="Facebook" class="rounded-0">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-300 d-flex align-items-center m-0 ml-15 text-white">{{ trans('public.facebook') }}</span>
                                    <div class="share-count-{{ $post->slug }}">
                                        <span class="font-weight-300 d-flex align-items-center m-0 ml-1 text-white">({{ number_format(intval($post->facebook_shares)) }})</span>
                                    </div>                                    
                                </div>
                            </a>
                        </div>                        
                        <div class="btn d-flex blog-socials blog-social-twitter rounded mr-15">
                            <a href="{{ $post->getShareLink('twitter') }}" class="d-flex" onclick="shareTwitter('{{ $post->slug }}')" target="_blank">
                                <img src="{{ asset('assets/aaipi/img/blog/socials/twitter.svg') }}" alt="Twitter" class="rounded-0">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-300 d-flex align-items-center m-0 ml-15 text-white">{{ trans('public.twitter') }}</span>
                                    <div class="share-count-{{ $post->slug }}">
                                        <span class="font-weight-300 d-flex align-items-center m-0 ml-1 text-white">({{ number_format(intval($post->twitter_shares)) }})</span>
                                    </div>    
                                </div>
                            </a>
                        </div>
                        <div class="btn d-flex blog-socials blog-social-linkedin rounded">
                            <a href="{{ $post->getShareLink('linkedin') }}" class="d-flex" onclick="shareLinkedin('{{ $post->slug }}')" target="_blank">
                                <img src="{{ asset('assets/aaipi/img/blog/socials/linkedin.svg') }}" alt="Linkedin" class="rounded-0">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-300 d-flex align-items-center m-0 ml-15 text-white">{{ trans('public.linkedin') }}</span>
                                    <div class="share-count-{{ $post->slug }}">
                                        <span class="font-weight-300 d-flex align-items-center m-0 ml-1 text-white">({{ number_format(intval($post->linkedin_shares)) }})</span>
                                    </div>   
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-4">

                {{-- Search Blog --}}
                <div class="rounded-lg shadow-sm mt-35 search-input bg-white px-20 py-25 flex-grow-1">
                    <form action="/blog" method="get" id="filtersForm">
                        <div class="form-group d-flex align-items-center m-0">
                            <input type="text" name="search" class="form-control input-search-blog" value="{{ request()->get('search') }}" placeholder="{{ trans('home.blog_search_placeholder') }}"/>
                            <button type="submit" class="btn btn-search-blog">
                                <i data-feather="search" width="20" height="20" class="">{{ trans('home.find') }}</i>
                            </button>
                        </div>
                </div>

                {{-- recent_posts --}}
                <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                    <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('site.recent_posts') }}</h3>

                    <div class="pt-15">

                        @foreach($blog as $post)
                            <div class="popular-post d-flex align-items-start mt-20">
                                <div class="popular-post-image rounded">
                                    <img src="{{ $post->image }}" class="img-cover rounded" alt="{{ $post->title }}">
                                </div>
                                <div class="popular-post-content d-flex flex-column ml-10">
                                    <a href="{{ $post->getUrl() }}">
                                        <h3 class="font-14 text-dark-blue">{{ truncate($post->title,40) }}</h3>
                                    </a>
                                    <span class="mt-auto font-12 text-gray">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- popular_posts --}}
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
                                    <span class="mt-auto font-12 text-gray">{{ \Carbon\Carbon::parse($popularPost->created_at)->translatedFormat('j M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- categories --}}
                <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                    <h3 class="category-filter-title font-16 font-weight-bold text-dark-blue">{{ trans('categories.categories') }}</h3>

                    <div class="pt-15">
                        {{-- @foreach($blogCategories as $blogCategory)
                            <a href="{{ $blogCategory->getUrl() }}" class="font-14 text-dark-blue d-block mt-15">{{ $blogCategory->title }}</a>
                        @endforeach --}}

                        @foreach ($blogCategoriesFilter as $dataName)
                        <div class="d-flex align-items-start justify-content-left mt-20">
                            <div class="custom-control custom-checkbox desible">
                                <input type="checkbox" name="searchkategori"
                                    id="filterType{{ $dataName->id }}" onchange="this.form.submit()"
                                    value="{{ $dataName->id }}"
                                    @if (in_array($dataName->id, request()->get('searchkategori', []))) checked="checked" @endif
                                    class="custom-control-input">
                                <label class="custom-control-label"
                                    for="filterType{{ $dataName->id }}"></label>
                            </div>
                            <label class="d-flex align-items-center cursor-pointer @if (in_array($dataName->id, request()->get('searchkategori', []))) text-primary @endif"
                                for="filterType{{ $dataName->id }}">
                                @if (request()->get('searchkategori', []))
                                    <i data-feather="chevron-right" width="20" height="20" class="mr-5"></i>
                                @endif
                                {{ $dataName->title }}</label>
                        </div>
                    @endforeach
                    </div>
                </div>

                {{-- <div class="mt-30 px-20 py-15 rounded-sm shadow-lg border border-gray300">
                    <h3 class="category-filter-title font-20 font-weight-bold">{{ trans('public.core_kompetency') }}</h3>

                    <div class="mt-20 d-flex  flex-wrap">
                    
                        @foreach($categories as $category)
                            @if(!empty($category->subCategories) and count($category->subCategories))
                                @foreach($category->subCategories as $subCategory)
                                    <div class="checkbox-button bordered-200 mt-5 mr-15">
                                        <input type="checkbox" name="categories[]" id="checkbox{{ $subCategory->id }}" value="{{ $subCategory->slug }}" @if(in_array($subCategory->id,request()->get('categories',[]))) checked="checked" @endif>
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
                </div> --}}
                </form>
            </div>
        </div>
        <div class="row">
            
            @if(!$similarPosts->isEmpty())
                <div class="col-12 mt-30">
                    <h3 class="font-20 font-weight-bold text-dark-blue">{{ trans('site.postingan_serupa') }}</h3>
                </div>
            @endif

                @foreach($similarPosts as $similarPost)
                    <div class="d-flex col-12 col-md-4 col-lg-4">
                        <div class="mt-30">
                            @include('web.default.blog.grid-list',['post' => $similarPost])
                        </div>
                    </div>
                @endforeach

            <div class="col-12">
                {{-- post Comments --}}
                @if($post->enable_comment)
                    @include('web.default.includes.comments',[
                            'comments' => $post->comments,
                            'inputName' => 'blog_id',
                            'inputValue' => $post->id
                        ])
                @endif
                {{-- ./ post Comments --}}
            </div>
        </div>
</section>

    @include('web.default.blog.share_modal')
@endsection

@push('scripts_bottom')
    <script>
        var webinarDemoLang = '{{ trans('webinars.webinar_demo') }}';
        var replyLang = '{{ trans('panel.reply') }}';
        var closeLang = '{{ trans('public.close') }}';
        var saveLang = '{{ trans('public.save') }}';
        var reportLang = '{{ trans('panel.report') }}';
        var reportSuccessLang = '{{ trans('panel.report_success') }}';
        var messageToReviewerLang = '{{ trans('public.message_to_reviewer') }}';
        var copyLang = '{{ trans('public.copy') }}';
        var copiedLang = '{{ trans('public.copied') }}';
    </script>

    <script src="/assets/default/js/parts/comment.min.js"></script>
    <script src="/assets/default/js/parts/blog.min.js"></script>
    <script src="/assets/aaipi/js/blog.js"></script>

@endpush
