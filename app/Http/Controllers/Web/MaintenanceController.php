<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class MaintenanceController extends Controller
{
    public function index()
    {
        /*if (empty(getFeaturesSettings('mobile_app_status')) or !getFeaturesSettings('mobile_app_status')) {
            return redirect('/');
        }*/

        $data = [
            'pageTitle' => trans('update.maintenance'),
            'pageRobot' => getPageRobotNoIndex(),
        ];

        return view('web.default.maintenance.index', $data);
    }
}
