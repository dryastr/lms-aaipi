@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        <p style="font-size: 23px; font-weight: bold;">{{ $confirm['title'] }}</p>
        <p style="color:#45526C; font-size: 15px;">{!! nl2br($confirm['message']) !!}</p>

        <p class="code" style="color:#45526C; font-size: 15px;">{{ $confirm['code'] }}</p>

        <p style="color:#45526C; font-size: 15px;">{{ trans('notification.email_ignore_msg') }}</p>
    </td>
@endsection
