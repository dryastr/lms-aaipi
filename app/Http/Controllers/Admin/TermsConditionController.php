<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function index()
    {
        $trem = TermsCondition::get();

        return view('admin.trems_condition.index', compact('trem'));
        // return view('admin.trems_condition.index');
    }

    public function create()
    {
        return view('admin.trems_condition.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $data = [
            'content' => $request->content
        ];
    
        
        $termsCondition = TermsCondition::first();
    
        if ($termsCondition) {
         
            $termsCondition->update($data);
        } else {
         
            TermsCondition::create($data);
        }
    
        return redirect(getAdminPanelUrl().'/terms-condition')->with('success', 'Terms and Conditions saved successfully.');
    }
    

    public function edit($id)
    {
      

        $bundle = TermsCondition::findOrFail($id);

        $groups = [
            'pageTitle' => trans('admin/pages/groups.edit_page_title'),
            'bundle' => $bundle,
        ];

        // dd($groups);

        return view('admin.trems_condition.create', $groups);
    }

    public function update(Request $request, $id)
    {
        

        $group = TermsCondition::findOrFail($id);

        $data = $request->all();
    
        $group->update($data);

        return redirect(getAdminPanelUrl().'/terms-condition');
    }

    public function destroy(Request $request, $id)
    {
        

        $group = TermsCondition::findOrFail($id);

        $group->webinars()->delete();

        $group->delete();

        // cache()->forget(TermsCondition::$cacheKey);

        if (! empty($group)) {
            $group->delete();

            return redirect(getAdminPanelUrl().'/terms-condition');
        }

    }

    public function show()
    {
        $contents = TermsCondition::get();

        return view('admin.trems_condition.show', compact('contents'));
        // return view('admin.trems_condition.index');
    }


}
