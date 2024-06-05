<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossCompetency;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TematikController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin_thematic_list');

        $groups = CrossCompetency::where('types', 'thematic')->get();

        return view('admin.tematik.index', ['groups' => $groups]);
    }

    public function create(Request $request)
    {
        $this->authorize('admin_thematic_create');

        $nullParentData = CrossCompetency::whereNull('parent_id')->get();

        return view('admin.tematik.create', ['nullParentData' => $nullParentData]);

    }

    public function show(Request $request)
    {
        $groups = CrossCompetency::all();

        return view('web.default.pages.classes', ['groups' => $groups]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_thematic_create');

        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'required',
            // tambahkan validasi required untuk sub_categories jika diperlukan
            // 'sub_categories' => 'required|array',
            // 'sub_categories.*.title' => 'required|max:255',
            // 'sub_categories.*.slug' => 'required|max:255',
            // 'sub_categories.*.icon' => 'required|max:255',
        ]);

        $data = $request->all();
        // $data['created_at'] = time();
        $data['creator_id'] = auth()->user()->id;
        $data['types'] = 'thematic';

        unset($data['_token']);

        $group = CrossCompetency::create($data);

        $users = $request->input('users');

        return redirect(getAdminPanelUrl().'/tematik');
    }

    public function edit($id)
    {
        $this->authorize('admin_thematic_edit');

        $group = CrossCompetency::findOrFail($id);

        $groups = [
            'pageTitle' => trans('admin/pages/groups.edit_page_title'),
            'group' => $group,
            'groupRegistrationPackage' => $group->groupRegistrationPackage,
            'nullParentData' => CrossCompetency::whereNull('parent_id')->get(),
        ];

        // dd($groups);

        return view('admin.tematik.create', $groups);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_thematic_edit');

        $group = CrossCompetency::findOrFail($id);

        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['updated_at'] = now();
        unset($data['_token']);

        $group->update($data);

        return redirect(getAdminPanelUrl().'/tematik');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_thematic_delete');

        $group = CrossCompetency::findOrFail($id);

        $group->webinars()->delete();

        $group->delete();

        cache()->forget(CrossCompetency::$cacheKey);

        if (! empty($group)) {
            $group->delete();

            return redirect(getAdminPanelUrl().'/tematik');
        }

    }
}
