<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;

class TimeZonesController extends Controller
{
    //
    public function index()
    {

        $list = getListOfTimezones();

        return apiResponse2(1, 'retrieved', trans('api.public.retrieved'),

            $list
        );
    }
}
