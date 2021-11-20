<?php

namespace App\Http\Controllers;

use App\Models\Violence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViolenceController extends Controller
{
    public function showCreateViolencePage()
    {
        return view('dashboard.pages.create_violence_type');
    }

    public function createViolenceType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $new_violence_type = new Violence();

        $new_violence_type->name = $request->name;
        $new_violence_type->description = $request->description;

        if($new_violence_type->save())
        {
            return back()->withSuccess('Violence type has been created successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to create the violence type.']);
        }

    }

    public function showViolenceTypesPage()
    {
        $violence_types = Violence::paginate(10);
        return view('dashboard.pages.violence_types', ['violence_types' => $violence_types, 'no' => 1]);
    }

    public function showEditViolenceTypePage($id)
    {
        $violence_type = Violence::find($id);

        return view('dashboard.pages.edit_violence_type', ['violence_type' => $violence_type]);
    }

    public function updateViolenceType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $violence_type = Violence::find($request->id);

        $violence_type->name = $request->name;
        $violence_type->description = $request->description;

        if($violence_type->save())
        {
            return back()->withSuccess('Violence type has been updated successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to update the violence type.']);
        }


    }

    public function showConfirmDeleteViolenceTypePage($id)
    {
        return view('dashboard.pages.confirm_delete_violence_type', ['id' => $id]);
    }
    
    public function deleteViolenceType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $violence_type = Violence::find($request->id);

        if($violence_type->delete())
        {
            return redirect()->route('violence.types.view')->withSuccess('Deleted violence type ' . $violence_type->name . ' successfully!');
        }
        else 
        {
            return back()->with(['error' => 'Failed to delete the Violence Type.']);
        }
    }

   

}
