@php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
@endphp

<div class="tab-pane mt-3 fade @if(empty($social)) show active @endif" id="url_member_area" role="tabpanel" aria-labelledby="url_member_area-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ getAdminPanelUrl() }}/settings/main" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="other">
                <input type="hidden" name="name" value="url_member_area">

                <div class="form-group">
                    <label>{{ trans('admin/main.url_member_area') }}</label>
                    <input type="text" name="value[url_member_area]" value="{{ (!empty($itemValue) and !empty($itemValue['url_member_area'])) ? $itemValue['url_member_area'] : old('url_member_area') }}" class="form-control "/>
                </div>

                <button type="submit" class="btn btn-primary">{{ trans('admin/main.save_change') }}</button>
            </form>
        </div>
    </div>
</div>

