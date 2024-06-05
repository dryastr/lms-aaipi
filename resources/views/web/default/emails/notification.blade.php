@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        <p style="font-size: 20px">{{ $notification['title'] }}</p>
        <p style="color:#45526C !important;">{!! nl2br($notification['message']) !!}</p>

        <p>{{ trans('notification.email_ignore_msg') }}</p>
    </td>
@endsection