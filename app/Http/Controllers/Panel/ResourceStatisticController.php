<?php

namespace App\Http\Controllers\Panel;

use App\User;
use App\Models\Resources;
use Illuminate\Http\Request;
use App\Models\ResourcesDownload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResourceStatisticController extends Controller
{
    public function index(Request $request, $resourceId)
    {
        $resource = Resources::find($resourceId);
        
        if (!$resource) {
            abort(404);
        }
    
        $downloadsCount = ResourcesDownload::where('resource_id', $resourceId)->count();
        $userRoleDownloads = $this->userRoles($request, $resourceId);
        $userDownloads = $this->userRoleDownloads($request, $resourceId);
    
        $data = [
            'pageTitle' => trans('update.course_statistics'),
            'resource' => $resource,
            'downloadsCount' => $downloadsCount,
            'userRoleDownloads' => $userRoleDownloads,
            'userDownloads' => $userDownloads,
        ];

        // dd($data['userRoleDownloads']);
    
        return view('web.default.panel.resources.resource_statistics.index', $data);
    }
     

    public function userRoles(Request $request, $resourceId)
    {
        return User::join('resources_download', 'users.id', '=', 'resources_download.user_id')
            ->select('users.role_name', \DB::raw('count(*) as total_downloads'))
            ->where('resources_download.resource_id', $resourceId)
            ->groupBy('users.role_name')
            ->get();
    }

    public function userRoleDownloads(Request $request, $resourceId)
    {
        $downloads = User::join('resources_download', 'users.id', '=', 'resources_download.user_id')
            ->select('users.*', \DB::raw('count(resources_download.id) as total_downloads'))
            ->where('resources_download.resource_id', $resourceId)
            ->groupBy('users.id')
            ->paginate(10);
        
        return $downloads;
    }
    
}