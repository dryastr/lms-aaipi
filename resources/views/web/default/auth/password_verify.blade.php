@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td>
        <p style="font-size: 23px; font-weight: bold">{{ trans('auth.verify_your_email_address') }}</p>
        <p style="color:#45526C; font-size: 15px;">{{ trans('auth.desc_your_email_address') }}</p>
        <div>    
            <a href="{{ url('/reset-password/' . $token . '?email=' . $email) }}" style="color:white;">
                <Button style="background-color: #CE0028; width: 100%; color: white; padding: 12px 0; border-radius: 8px; border: none; font-size: 15px;">
                    {{ trans('auth.click_here') }}
                </Button>
            </a>
        </div>
    </td>
@endsection
