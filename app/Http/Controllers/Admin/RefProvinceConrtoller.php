<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossCompetency;
use App\Models\Group;
use App\Models\GroupRegistrationPackage;
use App\Models\PetaProvinsi;
use App\Models\RefProvince;
use Illuminate\Http\Request;

class RefProvinceConrtoller extends Controller
{
    public function index()
    {
        $provinces = PetaProvinsi::paginate(20);

        return view('admin.province.index', compact('provinces'));
    }

    public function create()
    {
        return view('admin.province.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'province_name' => 'required',
            'code' => 'required',
            'shape' => 'required',
        ]);
     
        PetaProvinsi::create([
            'propinsi_name' => $validatedData['province_name'],
            'province_code' => $validatedData['code'],
            'mst_propinsi_id' => $request->code,
            'shape' => $validatedData['shape'],
        ]);

        return redirect(getAdminPanelUrl().'/provinsi')->with('success', 'Province added successfully.');
    }

    public function edit($id)
    {
        // $this->authorize('admin_thematic_edit');

        $group = PetaProvinsi::findOrFail($id);

        $provinces = [
            // 'pageTitle' => trans('admin/pages/groups.edit_page_title'),
            'group' => $group,
            'provinces' => RefProvince::all(),
            // Uncomment baris berikut jika Anda memiliki data userGroups
            // 'userGroups' => $userGroups,
            // 'groupRegistrationPackage' => $group->groupRegistrationPackage,
            // 'nullParentData' => CrossCompetency::whereNull('parent_id')->get()
        ];

        return view('admin.province.create', $provinces);
    }

    public function update(Request $request, $id)
{
    // $this->authorize('admin_group_edit');

    $provinces = PetaProvinsi::findOrFail($id);

    // $this->validate($request, [
    //     'users' => 'required|array',
    //     'name' => 'required',
    // ]);

    $provinces->update([
        'propinsi_name' => $request->province_name,
        'province_code' => $request->code,
        'mst_propinsi_id' => $request->code,
        'shape' => $request->shape,
    ]);

    return redirect(getAdminPanelUrl().'/provinsi');
}

    public function destroy(Request $request, $id)
    {
        // $this->authorize('admin_bundles_delete');

        $provinces = PetaProvinsi::findOrFail($id);

        if (! empty($provinces)) {
            $provinces->delete();

            return redirect(getAdminPanelUrl().'/provinsi')->with('success', 'City deleted successfully.');
        }

    }
}
