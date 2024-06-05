@push('styles_top')
    <link rel="stylesheet" href="/assets/aaipi/css/web/default/home.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-straight/css/uicons-regular-straight.css'>
@endpush

@if (!empty($paginator) and $paginator->hasPages())
    <nav class="d-flex justify-content-center">
        <ul class="custom-pagination paginate-groups d-flex align-items-center justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="previous previous-disable-custom disabled">
                    <i class="fi fi-rs-arrow-left disabled-arrow-icon"></i>
                </li>
            @else
                <li class="previous previous-custom">
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <i class="fi fi-rs-arrow-left h-arrow-icon"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)

                @php
                    $separate = false;
                @endphp

                @if (is_array($element))
                    @foreach ($element as $page => $url)


                        @if(($page < 2) or ($page + 1 > $paginator->lastPage()) or (($page < $paginator->currentPage() + 2) and ($page > $paginator->currentPage() - 2)))
                            @php
                                $separate = true;
                            @endphp

                            @if ($page == $paginator->currentPage())
                                <li><span class="active">{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif

                        @elseif($separate)
                            <li aria-disabled="true"><span>...</span></li>

                            @php
                                $separate = false;
                            @endphp
                        @endif
                    @endforeach
                @endif

            @endforeach

            @if ($paginator->hasMorePages())
                <li class="next next-custom">
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <i class="fi fi-rs-arrow-right h-arrow-icon"></i>
                    </a>
                </li>
            @else
                <li class="next next-disable-custom disabled">
                    <i class="fi fi-rs-arrow-right disabled-arrow-icon"></i>
                </li>
            @endif

            {{--<li><span class="d-flex align-items-center justify-content-center">...</span></li>--}}
        </ul>
    </nav>
@endif
