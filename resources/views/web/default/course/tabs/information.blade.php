@php
    $learningMaterialsExtraDescription = !empty($course->webinarExtraDescription) ? $course->webinarExtraDescription->where('type','learning_materials') : null;
    $companyLogosExtraDescription = !empty($course->webinarExtraDescription) ? $course->webinarExtraDescription->where('type','company_logos') : null;
    $requirementsExtraDescription = !empty($course->webinarExtraDescription) ? $course->webinarExtraDescription->where('type','requirements') : null;
@endphp

<link rel="stylesheet" href="/assets/aaipi/css/web/default/course.css">

{{-- Installments --}}
@if(!empty($installments) and count($installments) and getInstallmentsSettings('installment_plans_position') == 'top_of_page')
    @foreach($installments as $installmentRow)
        @include('web.default.installment.card',['installment' => $installmentRow, 'itemPrice' => $course->getPrice(), 'itemId' => $course->id, 'itemType' => 'course'])
    @endforeach
@endif

@if(!empty($learningMaterialsExtraDescription) and count($learningMaterialsExtraDescription))
    <div class="mt-20 rounded-sm border bg-info-light p-15">
        <h3 class="font-16 text-secondary font-weight-bold mb-15">{{ trans('update.what_you_will_learn') }}</h3>

        @foreach($learningMaterialsExtraDescription as $learningMaterial)
            <p class="d-flex align-items-start font-14 text-gray mt-10">
                <i data-feather="check" width="18" height="18" class="mr-10 webinar-extra-description-check-icon"></i>
                {{-- <span class="">{{ $learningMaterial->value }}</span> --}}
            </p>
        @endforeach
    </div>
@endif

@if(isset($course) && $course)
    @if($course->description)
        <div class="mt-20">
            <h2 class="section-title after-line">{{ trans('product.Webinar_description') }}</h2>
            <div class="mt-15 course-description">
                <div style="width: 100%; word-wrap: break-word;">
                    {!! nl2br($course->description) !!}
                </div>
            </div>
        </div>
    @endif
@elseif(isset($resource) && $resource)
    @if($resource->description)
        <div class="mt-20">
            <h2 class="section-title after-line">{{ trans('product.Webinar_description') }}</h2>
            <div class="mt-15 course-description">
                <div style="width: 100%; word-wrap: break-word;">
                    {!! nl2br($resource->description) !!}
                </div>
            </div>
        </div>
    @endif
@endif


@if(!empty($companyLogosExtraDescription) and count($companyLogosExtraDescription))
    <div class="mt-20 rounded-sm border bg-white p-15">
        <div class="mb-15">
            <h3 class="font-16 text-secondary font-weight-bold">{{ trans('update.suggested_by_top_companies') }}</h3>
            <p class="font-14 text-gray mt-5">{{ trans('update.suggested_by_top_companies_hint') }}</p>
        </div>

        <div class="row">
            @foreach($companyLogosExtraDescription as $companyLogo)
                <div class="col text-center">
                    <img src="{{ $companyLogo->value }}" class="webinar-extra-description-company-logos" alt="{{ trans('update.company_logos') }}">
                </div>
            @endforeach
        </div>
    </div>
@endif

@if(!empty($requirementsExtraDescription) and count($requirementsExtraDescription))
    <div class="mt-20">
        <h3 class="font-16 text-secondary font-weight-bold mb-15">{{ trans('update.requirements') }}</h3>

        @foreach($requirementsExtraDescription as $requirementExtraDescription)
            <p class="d-flex align-items-start font-14 text-gray mt-10">
                <i data-feather="check" width="18" height="18" class="mr-10 webinar-extra-description-check-icon"></i>
                {{-- <span class="">{{ $requirementExtraDescription->value }}</span> --}}
            </p>
        @endforeach
    </div>
@endif

{{-- course prerequisites --}}
@if(!empty($course->prerequisites) and $course->prerequisites->count() > 0)

    <div class="mt-20">
        <h2 class="section-title after-line">{{ trans('public.prerequisites') }}</h2>

        @foreach($course->prerequisites as $prerequisite)
            @if($prerequisite->prerequisiteWebinar)
                @include('web.default.includes.webinar.list-card',['webinar' => $prerequisite->prerequisiteWebinar])
            @endif
        @endforeach
    </div>
@endif
{{-- ./ course prerequisites --}}

{{-- course FAQ --}}
<div class="container container_webinar">
@if(!empty($course->faqs) and $course->faqs->count() > 0)
    <div class="mt-20">
        <div class="d-block d-sm-flex justify-content-between">
            <div class="">
                <h2 class="">{{ trans('public.faq') }}</h2>
            </div>
            <div class=" d-flex">
                <div class="time bg-gray200 d-flex align-items-center flex-column justify-content-center" style="">    
                    <div class="font-bold "> {{ $course->faqs->count() }}</div>
                    <div class="font-12"> {{ trans('public.topic') }}</div>
                </div>
            <div class="time bg-gray200 d-flex align-items-center flex-column justify-content-center" style="">
            <div class="">{{ convertMinutesToHourAndMinute(!empty($course->duration) ? $course->duration : 0) }}</div>
            <div  class="font-12"> {{ trans('home.hours') }} </div> 
             </div>
            <div class="time bg-gray200  d-flex align-items-center flex-column justify-content-center" style="">
                <div class="">{{ $course->sales_count }}</div>
                {{-- <div class="">{{ $course->video_demo }}</div>  --}}
                <div class="font-12"> {{trans('quiz.participant') }}</div>    
            </div>
        </div>
        </div>

        <div class="accordion-content-wrapper mt-15" id="accordion" role="tablist" aria-multiselectable="true">
                @php
                $groupedFaqs = $course->faqs->groupBy('lesson_id');
                $counter = 1;
              @endphp

            <div class="accordion-content-wrapper accordion-content-wrapper-index mt-15" id="accordion" role="tablist" aria-multiselectable="true">
                @php $counter = 1; @endphp
            
                @foreach($course->faqs as $faq)
                    <div href="#collapseFaq{{ $faq->id }}" aria-controls="collapseFaq{{ $faq->id }}" class="accordion-row rounded-sm shadow-lg border mt-20 py-20 px-35" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">
                        <div class="font-weight-bold font-14 text-secondary" role="tab" id="faq_{{ $faq->id }}">
                            <div href="#collapseFaq{{ $faq->id }}" aria-controls="collapseFaq{{ $faq->id }}" class="d-flex align-items-center justify-content-between" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">
                                <span>{{ $faq->title }}</span>
                                <div href="#collapseFaq{{ $faq->id }}" aria-controls="collapseFaq{{ $faq->id }}" class="d-flex align-items-center" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">
                                    <span class="mr-20">{{ trans('public.topic')}} {{ $counter++ }}</span>
                                    <i class="collapse-chevron-icon" data-feather="chevron-down" width="25" class="text-gray"></i>
                                </div>
                            </div>
                        </div>
                        <div id="collapseFaq{{ $faq->id }}" aria-labelledby="faq_{{ $faq->id }}" class=" collapse" role="tabpanel">
                            <div class="panel-collapse text-gray">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
    </div>
@endif
</div>
{{-- ./ course FAQ --}}

{{-- Installments --}}
@if(!empty($installments) and count($installments) and getInstallmentsSettings('installment_plans_position') == 'bottom_of_page')
    @foreach($installments as $installmentRow)
        @include('web.default.installment.card',['installment' => $installmentRow, 'itemPrice' => $course->getPrice(), 'itemId' => $course->id, 'itemType' => 'course'])
    @endforeach
@endif

{{-- course Comments --}}
{{-- @include('web.default.includes.comments',[
        'comments' => $course->comments,
        'inputName' => 'webinar_id',
        'inputValue' => $course->id
    ]) --}}
{{-- ./ course Comments --}}
