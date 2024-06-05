@php
$progressSteps = [
        1 => [
            'lang' => 'public.basic_information',
            'icon' => 'customer-data'
        ],

        2 => [
            'lang' => 'public.images',
            'icon' => 'add-image'
        ],

        3 => [
            'lang' => 'public.about',
            'icon' => 'resume'
        ],

        4 => [
            'lang' => 'public.educations',
            'icon' => 'academic'
        ],

        5 => [
            'lang' => 'public.experiences',
            'icon' => 'job-search'
        ],

        6 => [
            'lang' => 'public.occupations',
            'icon' => 'worker'
        ],

        7 => [
            'lang' => 'public.identity_and_financial',
            'icon' => 'benefit'
        ]
    ];

    if(!$user->isUser()) {
        $progressSteps[8] =[
            'lang' => 'public.zoom_api',
            'icon' => 'zoom'
        ];

        $progressSteps[9] =[
            'lang' => 'public.extra_information',
            'icon' => 'extra_info'
        ];
    }

    if(!$user->isUser()) {
        $progressSteps[8] =[
            'lang' => 'public.zoom_api',
            'icon' => 'zoom'
        ];

        $progressSteps[9] =[
            'lang' => 'public.extra_information',
            'icon' => 'extra_info'
        ];
    }

    $currentStep = empty($currentStep) ? 1 : $currentStep;
@endphp


<div class="webinar-progress d-block d-lg-flex align-items-center panel-shadow panel-color rounded-sm">

    @foreach($progressSteps as $key => $step)
        <div class="progress-item progress-bg d-flex px-15 align-items-center {{ $key == $currentStep ? 'active' : '' }}">
            <a href="@if(!empty($organization_id)) /panel/manage/{{ $user_type ?? 'instructors' }}/{{ $user->id }}/edit/step/{{ $key }} @else /panel/setting/step/{{ $key }} @endif" class="progress-icon bg-icon-progress p-10 d-flex align-items-center justify-content-center {{ $key == $currentStep ? 'active' : '' }}" data-toggle="tooltip" data-placement="top" title="{{ trans($step['lang']) }}">
                <img src="/assets/default/img/icons/{{ $step['icon'] }}.svg" class="img-cover" alt="">
            </a>

            <div class="ml-10 {{ $key == $currentStep ? '' : 'd-lg-none' }}">
                <h4 class="font-16 text-primary font-weight-bold">{{ trans($step['lang']) }}</h4>
            </div>
        </div>
    @endforeach
</div>
