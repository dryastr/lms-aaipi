<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossCompetency;
// use App\Models\Webinar;
use Illuminate\Http\Request;

class CrossCompetencyController extends Controller
{
    public function index()
    {
        removeContentLocale();

        $this->authorize('admin_cross_competency_list');

        $cross_competency = CrossCompetency::where('types', 'crosscom')->paginate(10);

        $data = [
            'pageTitle' => trans('admin/pages/cross_competency.admin_cross_competency_page_title'),
            'cross_competency' => $cross_competency,
        ];

        // dd('admin_cross_competency');

        return view('admin.cross_competency.list', $data);
    }

    public function create()
    {
        $this->authorize('admin_cross_competency_create');

        $data = [
            'pageTitle' => trans('admin/main.crosscom_new_page_title'),
        ];

        // dd('admin_cross_competency_create');
        return view('admin.cross_competency.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_cross_competency_create');

        $this->validate($request, [
            'name' => 'required|min:3|max:128',
        ]);

        $data = $request->all();
        // $data['created_at'] = time();
        $data['creator_id'] = auth()->user()->id;

        $currentMenu = 'crosscom';
        $data['types'] = $currentMenu;

        $group = CrossCompetency::create($data);
        $group->save();

        cache()->forget(CrossCompetency::$cacheKey);

        removeContentLocale();

        return redirect(getAdminPanelUrl().'/cross-competency');
    }

    public function edit($id)
    {
        $this->authorize('admin_cross_competency_edit');

        $crossCompetency = CrossCompetency::findOrFail($id);

        // dd($crossCompetency);

        $data = [
            'pageTitle' => trans('admin/main.crosscom_edit_page_title'),
            'crossCompetency' => $crossCompetency,
        ];

        return view('admin.cross_competency.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_cross_competency_edit');

        $this->validate($request, [
            'name' => 'required|min:3|max:128',
        ]);

        $crossCompetency = CrossCompetency::findOrFail($id);

        $data = $request->all();
        $crossCompetency->update($data);

        cache()->forget(CrossCompetency::$cacheKey);

        removeContentLocale();

        return redirect(getAdminPanelUrl().'/cross-competency');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_cross_competency_delete');

        $category = CrossCompetency::findOrFail($id);

        $category->webinars()->delete();

        $category->delete();

        cache()->forget(CrossCompetency::$cacheKey);

        return redirect(getAdminPanelUrl().'/cross-competency');
    }
}
