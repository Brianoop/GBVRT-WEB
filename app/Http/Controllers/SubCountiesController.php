<?php

namespace App\Http\Controllers;

use App\Models\SubCounties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SubCountiesController extends Controller
{
    public function showCreateSubcountyPage()
    {
        return view('dashboard.pages.create_sub_county');
    }

    public function showSubCounties()
    {
        $sub_counties = SubCounties::paginate(10);

        return view('dashboard.pages.sub_counties',
        [
            'sub_counties' => $sub_counties,
            'no' => 1
        ]
    );
    }

    public function createSubcounty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $new_sub_county = new SubCounties();

        $new_sub_county->name = $request->name;

        if($new_sub_county->save())
        {
            return back()->withSuccess('Sub County has been created successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to create the Sub County.']);
        }

    }

    public function showEditSubCountyPage($id)
    {
        $sub_county = SubCounties::find($id);

        return view('dashboard.pages.edit_sub_county',
        [
            'sub_county' => $sub_county
        ]
    );
    }

    public function updateSubCounty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $sub_county = SubCounties::find($request->id);

        $sub_county->name = $request->name;

        if($sub_county->save())
        {
            return back()->withSuccess('Update successful!');
        }
        else 
        {
            return back()->with(['error' => 'Failed to update the Sub County.']);
        }
    }

    
}
