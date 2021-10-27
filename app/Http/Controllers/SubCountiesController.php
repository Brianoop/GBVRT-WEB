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
}
