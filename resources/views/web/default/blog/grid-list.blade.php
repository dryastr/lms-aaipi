<div class="blog-grid-card">
    <div class="blog-grid-image">
        <img src="{{ $post->image }}" class="img-cover" alt="{{ $post->title }}">
    </div>

    <div class="blog-grid-detail blog-grid-detail-custom">
        <div class="d-flex justify-content-between align-items-center">
            <span class="badge badge-subtitle d-flex align-items-center">
                {{-- data dummy statis (!dinamis) --}}
                {{ $post->category->title }}
            </span>
            <div class="blog-grid-footer d-flex align-items-center justify-content-between">
                {{-- <span>{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j M Y') }}</span> --}}
                <span>
                    {{ \Carbon\Carbon::parse($post->created_at)->locale('id')->translatedFormat('j F Y | H:i') }}
                </span>
            </div>
        </div>
        
        <a href="{{ $post->getUrl() }}">
            <h3 class="blog-grid-title mt-10">{{ $post->title }}</h3>
        </a>

        <div class="mt-20 blog-grid-desc">{!! truncate(strip_tags($post->description), 160) !!}</div>
    </div>
</div>
