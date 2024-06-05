@php
    $progressSteps = [
        1 => [
            'name' => 'basic_information',
            'icon' => 'customer-data-black'
        ],

        2 => [
            'name' => 'extra_information',
            'icon' => 'resume'
        ],

        3 => [
            'name' => 'pricing',
            'icon' => 'icon-wallet'
        ],

        4 => [
            'name' => 'content',
            'icon' => 'new-folder'
        ],

        5 => [
            'name' => 'prerequisites',
            'icon' => 'video-file'
        ],

        6 => [
            'name' => 'faq',
            'icon' => 'faq-answers-website-communications-question'
        ],

        7 => [
            'name' => 'quiz_certificate',
            'icon' => 'certificate'
        ],

    ];

    if (empty(getGeneralOptionsSettings('direct_publication_of_courses'))) {
        $progressSteps[8] = [
            'name' => 'message_to_reviewer',
            'icon' => 'shield_done'
        ];
    }

    $currentStep = empty($currentStep) ? 1 : $currentStep;
@endphp


<div class="webinar-progress d-block d-lg-flex align-items-center panel-shadow panel-color rounded-sm">

    @foreach($progressSteps as $key => $step)
        <div class="progress-item progress-bg d-flex px-15 align-items-center {{ $key == $currentStep ? 'active' : '' }}">
            <button type="button" data-step="{{ $key }}" class="js-get-next-step progress-icon bg-icon-progress p-0 border-0 progress-icon p-10 d-flex align-items-center justify-content-center{{ $key == $currentStep ? 'active' : '' }}" data-toggle="tooltip" data-placement="top" title="{{ trans('public.' . $step['name']) }}">
                <img src="/assets/default/img/icons/{{ $step['icon'] }}.svg" class="img-cover" alt="">
            </button>

            <div class="ml-10 {{ $key == $currentStep ? '' : 'd-lg-none' }}">
                <span class="font-14 text-gray">{{ trans('webinars.progress_step', ['step' => $key,'count' => $stepCount]) }}</span>
                <h4 class="font-16 text-primary font-weight-bold">{{ trans('public.' . $step['name']) }}</h4>
            </div>
        </div>
    @endforeach
</div>
