<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplaintsController extends Controller
{
    private $complaints;

    public function __construct(Complaints $complaints)
    {
        $this->complaints = $complaints;
    }

    public function showComplaintsPage()
    {
        return view('dashboard.pages.complaints');
    }

    public function saveComplaint(Request $request)
    {
        
        $request->validate([
            'user_id' => 'required|integer',
            'content' => 'required|string'
        ]);

        try
        {
            $user = User::findOrFail($request->user_id);
        }
        catch(ModelNotFoundException $e)
        {
            return back()->with([
                'status' => false,
                'message' => 'A problem occurred while registering your complaint.']);
        }

        $new_complaint = new Complaints();
        $new_complaint->users_id = $request->user_id;
        $new_complaint->content = $request->content;

        if($new_complaint->save())
        {
            return back()->with([
                'status' => true,
                'message' => 'Your complaint has been registered successfully.']);
        }
        else {
            return back()->with([
                'status' => false,
                'message' => 'A problem occurred while registering your complaint.']);
        }



    }

    public function showViewMyComplaintsPage()
    {
        $logged_in_users_complaints = $this->complaints::where('users_id', auth()->user()->id)->paginate(10);

        return view('dashboard.pages.view_my_complaints', [
            'users_complaints' => $logged_in_users_complaints
        ]);
    }

    public function showConfirmDeleteComplaint($id)
    {
        return view('dashboard.pages.confirm_delete_complaint', ['id' => $id]);
    }

    public function deleteMyComplaint(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        dd('Yes');
    }
}
