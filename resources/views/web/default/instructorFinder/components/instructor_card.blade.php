@php
    $price = (!empty($instructor->meeting)) ? $instructor->meeting->amount : 0;
    $discount = (!empty($price) and !empty($instructor->meeting) and !empty($instructor->meeting->discount) and $instructor->meeting->discount > 0) ? $instructor->meeting->discount : 0;
@endphp

<div class="col-md-6">
    <a href="{{ $instructor->getProfileUrl() }}" class="">
        <div class="position-relative d-flex flex-wrap instructor-finder-card border border-gray300 rounded-sm mt-20 flex-column">
                    @if(!empty($discount))
                    <span class="off-badge-custom  badge badge-danger">{{ trans('public.offer',['off' => $discount]) }}</span>
                @endif
            
            <div class="p-20 bg-profile-instructor-finder">
                <div class="d-flex align-items-center">
                    <div class="size-profile-instructor rounded-circle">
                        <img src="{{ $instructor->getAvatar(70) }}" class="img-cover bg-white rounded-circle" alt="{{ $instructor->full_name }}">
                    </div>
                    <div class="ml-15">
                    <h3 class="font-16 font-weight-bold text-white">{{ $instructor->full_name }}</h3>
                        <span class="d-block font-12 text-white">{{ $instructor->bio }}</span>
    
                        @if(!empty($instructor->occupations))
                            <div class="d-block font-14 text-white mt-5">
                                @foreach($instructor->occupations as $occupation)
                                    @if(!empty($occupation->category))
                                        <span>{{ $occupation->category->title }}{{ !($loop->last) ? ', ' : '' }}</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <p class="font-14 text-gray px-20 pt-20">{{ truncate($instructor->about, 200) }}</p>
    
            <div class="position-relative px-20 pb-20">
                <div class="d-flex justify-content-between align-items-center mt-20">
                    <div class="d-flex align-items-center">
                        <i data-feather="clock" width="18" height="18" class="text-dark-blue"></i>
        
                        <span class="font-14 font-weight-500 text-dark-blue ml-10">{{ $instructor->getTotalHoursTutoring() }} {{ trans('update.hours_tutoring') }}</span>
                    </div>
    
                    @include('web.default.includes.webinar.rate',['rate' => $instructor->rates()])
                </div>
    
                <div class="d-flex justify-content-between mt-15">
                    <div class="d-flex align-items-center flex-wrap">
                        @foreach($instructor->getBadges() as $badge)
                            <div class="badge-custom rounded-circle ml-5" data-toggle="tooltip" data-placement="bottom" data-html="true" title="{!! (!empty($badge->badge_id) ? nl2br($badge->badge->description) : nl2br($badge->description)) !!}">
                                <img src="{{ !empty($badge->badge_id) ? $badge->badge->image : $badge->image }}" class="img-cover rounded-circle" alt="{{ !empty($badge->badge_id) ? $badge->badge->title : $badge->title }}">
                            </div>
                        @endforeach
                    </div>
    
                    <div class="d-flex align-items-start">
                        @if(!empty($instructor->meeting) and !empty($instructor->meeting->meetingTimes) and count($instructor->meeting->meetingTimes))
                            @if(!empty($price) and $price > 0)
                                <div class="d-flex flex-column">
                                    <span class="font-20 font-weight-bold text-primary">{{ handlePrice(!empty($discount) ? ($price - ($price * $discount / 100)) : $price) }}</span>
        
                                    @if(!empty($discount))
                                        <span class="font-14 font-weight-500 text-gray text-decoration-line-through">{{ handlePrice($price) }}</span>
                                    @endif
                                </div>
        
                                <span class="font-14 font-weight-500 text-gray mt-5">/{{ trans('update.hour') }}</span>
                            @else
                                <span class="font-weight-bold text-primary font-14">{{ trans('public.free') }}</span>
                            @endif
                        @else
                            <span class="font-weight-bold text-danger font-12">{{ trans('update.not_available_for_meeting') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>