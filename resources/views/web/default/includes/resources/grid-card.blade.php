{{-- @include(getTemplate() . '.includes.webinar.grid-card', ['bestRateWebinars' => $bestRateWebinars]) --}}

<div class="webinar-card card-radius">
    <figure>
        <div class="image-box overflow-hidden">

            <a href="{{ $resource->getUrl() }}">
                <img src="{{ $resource->getImage() }}"onerror="this.onerror=null;this.src='{{createImageTitle($webinar->title)}}';" class="lazyload img-cover" alt="{{ $resource->title }}">
                {{-- <img src="{{ $webinar->getImage() }}"  class="lazyload img-cover" alt="{{ $webinar->title }}"> --}}
            </a>

        </div>

        <figcaption class="webinar-card-body card-radius-bottom">

            <a href="{{ $resource->getUrl() }}" class="title">
                <h3 class="mt-5 webinar-title font-weight-bold font-16 text-dark-blue" style="height: fit-content">{{ Str::slug($resource->title, ' ') }}</h3>
            </a>

            <div class="blog-grid-desc text-dark-blue mt-15">
                <div style="width: 100%; word-wrap: break-word;">
                    {{Str::limit(strip_tags($resource->description), 120)}}
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap mt-15">
                <div>
                    <div class="user-inline-avatar d-flex align-items-center">
                        <div class="avatar bg-gray200 avatar-size rounded-circle overflow-hidden">
                            <img src="{{ $resource->user->getAvatar() }}" class="img-cover" alt="{{ $resource->user->full_name }}">
                        </div>
                        <a href="{{ $resource->user->getProfileUrl() }}" target="_blank" class="user-name ml-5 text-dark-blue font-14">{{ $resource->user->full_name }}</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center text-center {{ strlen($resource->category->title) > 20 ? ' mb-10' : '' }}">
                    @if(!empty($resource->category))
                        <a href="{{ $resource->category->getUrl() }}" target="_blank" class="badge badge-primary rounded-pill py-5 px-10" title="{{ $resource->category->title }}">
                            {{-- {{ $resource->category->title }} --}}
                            {{ Str::limit($resource->category->title, 15) }}
                        </a>
                    @endif
                </div>
            </div>
        </figcaption>
    </figure>
</div>
