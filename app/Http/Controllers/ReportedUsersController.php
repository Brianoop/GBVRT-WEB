<?php

namespace App\Http\Controllers;
use App\Models\ReportedUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ReportedUsersController extends Controller
{
    private $reported_users;
    private $users;

    public function __construct(ReportedUsers $reported_users, User $users)
    {
        $this->reported_users = $reported_users;
        $this->users = $users;
    }

    public function reportAUser(Request $request)
    {
        $request->validate([
            'reporting_user' => 'required|integer',
            'reported_user' => 'required|integer',
            'details' => 'required|string'
        ]);

        try
        {
            $reporting_user = $this->users::findOrFail($request->reporting_user);
        }
        catch(ModelNotFoundException $e)
        {
            return back()->with([
                'status' => false,
                'message' => 'No reporting user ID found.']);
        }

        try
        {
            $reported_user = $this->users::findOrFail($request->reported_user);
        }
        catch(ModelNotFoundException $e)
        {
            return back()->with([
                'status' => false,
                'message' => 'No reported user ID found.']);
        }


        $new_reported_user = new ReportedUsers();
        $new_reported_user->reporting_user = $request->reporting_user;
        $new_reported_user->reported_user = $request->reported_user;
        $new_reported_user->details = $request->details;

        if($new_reported_user->save())
        {
            return back()->with([
                'status' => true,
                'message' => 'Your report has been received.']);
        }
        else {
            return back()->with([
                'status' => false,
                'message' => 'A problem occurred while creating your report.']);
        }

    }
}
