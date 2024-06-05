<div class="stars-card d-flex align-items-center m-0">
    @php
        $i = 5;
    @endphp

    @if((!empty($rate) and $rate > 0) or !empty($showRateStars))
        @if(empty($dontShowRate) or !$dontShowRate)
            <small class="mr-1 text-black">{{ $rate }}</small>
        @endif

        <i data-feather="star" width="15" height="15" class="active"></i>
        @isset($coursesCount)
            {{-- <small class="text-black">({{ $coursesCount }})</small> --}}
        @endisset
        @isset($instructorsCount)
            {{-- <small class="text-black">({{ $instructorsCount }})</small> --}}
        @endisset
    @endif
</div>
