<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetaKabKota;
use App\Models\PetaProvinsi;
use App\Models\RefCity;
use App\Models\RefProvince;
use Illuminate\Http\Request;

class RefCityController extends Controller
{
    public function index()
    {
        $city = PetaKabKota::with('propinsi')->paginate(20);

        return view('admin.kabupaten.index', compact('city'));
    }

    public function create()
    {
        $provinces = PetaProvinsi::all();

        return view('admin.kabupaten.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required',
            'province_id' => 'required',
            'code' => 'required',
            'shape' => 'required',
        ]);

        $provinsi = PetaProvinsi::find($request->province_id);
        // dd($provinsi);
        $propinsi_name = $provinsi ? $provinsi->propinsi_name : null;
    
        PetaKabKota::create([
            'mst_kabupaten_id' => $request->mst_kabupaten_id ?? null,
            'kabupaten_name' => $request->city_name,
            'alias' => $request->city_name,
            'shape' => $request->shape,
            'mst_propinsi_id' => $request->province_id,
            'province_code' => $request->province_id,
            'city_code' => $request->code,
            'propinsi_name' => $propinsi_name,
        ]);
        return redirect(getAdminPanelUrl().'/kabupaten')->with('success', 'Province added successfully.');
    }

    public function edit($id)
    {
        // $this->authorize('admin_thematic_edit');

        $group = PetaKabKota::findOrFail($id);

        $city = [
            // 'pageTitle' => trans('admin/pages/groups.edit_page_title'),
            'group' => $group,
            'provinces' => PetaProvinsi::all(),
            // Uncomment baris berikut jika Anda memiliki data userGroups
            // 'userGroups' => $userGroups,
            // 'groupRegistrationPackage' => $group->groupRegistrationPackage,
            // 'nullParentData' => CrossCompetency::whereNull('parent_id')->get()
        ];

        return view('admin.kabupaten.create', $city);
    }

    public function update(Request $request, $id)
    {
        $city = PetaKabKota::findOrFail($id);

        $request->validate([
            'kabupaten_name' => 'required|unique:peta_kabkota|max:255',
            'mst_provinsi_id' => 'required|exists:peta_provinsi,id',
            'city_code' => 'required',
            'shape' => 'required',
            'propinsi_name' => 'required',
        ]);

        $provinsi = PetaProvinsi::find($request->mst_provinsi_id);
        $propinsi_name = $provinsi ? $provinsi->propinsi_name : null;

        $city->update([
            'mst_kabupaten_id' => $request->mst_kabupaten_id ?? null,
            'kabupaten_name' => $request->kabupaten_name,
            'alias' => $request->kabupaten_name,
            'shape' => $request->shape,
            'mst_propinsi_id' => $request->mst_provinsi_id,
            'city_code' => $request->city_code,
        ]);

        return redirect(getAdminPanelUrl().'/kabupaten');
    }

    public function destroy(Request $request, $id)
    {
        // $this->authorize('admin_bundles_delete');

        $city = PetaKabKota::findOrFail($id);

        if (! empty($city)) {
            $city->delete();

            return redirect(getAdminPanelUrl().'/kabupaten')->with('success', 'City deleted successfully.');
        }

    }
}
