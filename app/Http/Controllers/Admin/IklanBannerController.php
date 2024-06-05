<?php

namespace App\Http\Controllers\admin;

use App\Models\IklanBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IklanBannerController extends Controller
{
    public function index()
    {
        removeContentLocale();

        $this->authorize('admin_iklan_banner');

        $iklanBanners = IklanBanner::paginate(10);

        $data = [
            'pageTitle' => trans('admin/main.iklan_banner'),
            'iklanBanners' => $iklanBanners,
        ];

        // dd('admin_iklan_banner');

        return view('admin.iklan_banner.index', $data);
    }

    public function create()
    {
        $this->authorize('admin_iklan_banner_create');

        $data = [
            'pageTitle' => trans('admin/main.iklan_banner_new'),
        ];

        // dd('admin_iklan_banner_create');
        return view('admin.iklan_banner.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_iklan_banner_create');

        $this->validate($request, [
            'title' => 'required|min:3|max:128',
            'image' => 'required',
            'url' => 'required',
            // 'target' => 'required',
        ]);

        $data = $request->all();
        $data['creator_id'] = auth()->user()->id;


        $group = IklanBanner::create($data);
        $group->save();

        removeContentLocale();

        return redirect(getAdminPanelUrl().'/ad-banners');
    }

    public function edit($id)
    {
        $this->authorize('admin_iklan_banner_edit');

        $group = IklanBanner::findOrFail($id);


        $data = [
            'pageTitle' => trans('admin/main.iklan_banner_edit'),
            'group' => $group,
        ];

        return view('admin.iklan_banner.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_thematic_edit');

        $group = IklanBanner::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|min:3|max:128',
            'image' => 'required',
            'url' => 'required',
        ]);

        $data = $request->all();
        $data['updated_at'] = now();
        // unset($data['_token']);

        $group->update($data);

        return redirect(getAdminPanelUrl().'/ad-banners');
    }

    public function destroy($id)
    {
        try {
            $this->authorize('admin_iklan_banner_delete');
    
            $group = IklanBanner::findOrFail($id);
    
            $group->delete();
    
            return redirect(getAdminPanelUrl().'/ad-banners');
        } catch (\Exception $e) {
            return back()->withError('Failed to delete ad banner.');
        }
    }
    
    
}
