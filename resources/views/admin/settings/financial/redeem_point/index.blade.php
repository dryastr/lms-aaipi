@php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
@endphp


<div class="tab-pane mt-3 fade  @if(request()->get('tab') == "redeem_point") active show @endif" id="redeem_point" role="tabpanel" aria-labelledby="redeem_point-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ getAdminPanelUrl() }}/settings/main" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="financial">
                <input type="hidden" name="name" value="redeem_point_user">


                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[redeem_point_user]" value="0">
                        <input type="checkbox" name="value[redeem_point_user]" id="redeem_point_userSwitch" value="1" {{ (!empty($itemValue) and !empty($itemValue['redeem_point_user']) and $itemValue['redeem_point_user']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="redeem_point_userSwitch">{{ trans('update.redeem') }}</label>
                    </label>
                </div>

                <button type="submit" class="btn btn-success">{{ trans('admin/main.save_change') }}</button>
            </form>
        </div>
    </div>


</div>


@push('scripts_bottom')
    <script>
        var saveSuccessLang = '{{ trans('webinars.success_store') }}';
        var specificationLang = '{{ trans('update.specification') }}';
        var valueLang = '{{ trans('update.value') }}';
    </script>
    <script src="/assets/default/js/admin/settings/offline_banks_credits.min.js"></script>
@endpush
