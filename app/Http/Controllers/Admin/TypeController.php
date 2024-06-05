<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossCompetency;
use App\Models\Group;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        removeContentLocale();

        $this->authorize('admin_type_list');

        $types = CrossCompetency::where('types', 'type')->paginate(10);

        $data = [
            'pageTitle' => trans('admin/main.type'),
            'types' => $types,
        ];

        // dd('admin_cross_competency');

        return view('admin.type.index', $data);
    }

    public function create()
    {
        $this->authorize('admin_type_create');

        // $nullParentData = CrossCompetency::whereNull('parent_id')->get();

        return view('admin.type.create');

    }

    public function show(Request $request)
    {
        $groups = Group::all();

        return view('web.default.pages.classes', ['groups' => $groups]);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_type_create');
        $request->validate([
            'name' => 'required|max:255', 
        ]);
        $data = $request->all();
        // $data['created_at'] = time();
        $data['creator_id'] = auth()->user()->id;
        $data['types'] = 'type';

        unset($data['_token']);

        $group = CrossCompetency::create($data);
        $users = $request->input('users');

        return redirect(getAdminPanelUrl().'/type');
    }

    public function edit($id)
    {
        $this->authorize('admin_type_edit');

        $group = CrossCompetency::findOrFail($id);

        $groups = [
            'pageTitle' => trans('admin/pages/groups.edit_page_title'),
            'group' => $group,
            'groupRegistrationPackage' => $group->groupRegistrationPackage,
        ];

        return view('admin.type.create', $groups);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_type_edit');

        $group = CrossCompetency::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['updated_at'] = now();
        unset($data['_token']);

        $group->update($data);

        return redirect(getAdminPanelUrl().'/type');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_type_delete');

        $group = CrossCompetency::findOrFail($id);

        $group->webinars()->delete();

        $group->delete();

        cache()->forget(CrossCompetency::$cacheKey);

        if (! empty($group)) {
            $group->delete();

            return redirect(getAdminPanelUrl().'/type');
        }

    }
}
