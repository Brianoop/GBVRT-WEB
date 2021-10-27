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
}
