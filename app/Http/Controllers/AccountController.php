<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AccountController extends Controller
{
    public function showAccountPage()
    {
        return view('dashboard.pages.account');
    }

    public function showCreateNewUserPage()
    {
        return view('dashboard.pages.create_new_user');
    }

    public function createNewAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'contact' => 'required|string|unique:users',
            'type' => 'required|integer',
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if($request->type == 2)
        {
            $validator = Validator::make($request->all(), [
                'organisation_name' => 'required|string',
                'brief_description' => 'required|string',
                'detailed_description' => 'required|string',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->contact = $request->contact;
        $new_user->type = $request->type;

        if(!empty($request->organisation_name) )
        {
            $new_user->organisation_name = $request->organisation_name;
        }

        if(!empty($request->brief_description) )
        {
            $new_user->brief_description = $request->brief_description;
        }

        if(!empty($request->detailed_description) )
        {
            $new_user->detailed_description = $request->detailed_description;
        }

        $new_user->password =  Hash::make($request->password);

        if($new_user->save())
        {
            return back()->withSuccess('New user account has been created successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to create the user account.'])->withInput();
        }
    }

    public function showAccountsPage()
    {
        $user_accounts = User::paginate(20);

        return view('dashboard.pages.accounts',['user_accounts' => $user_accounts, 'no' => 1]);
    }

    public function showEditAccountPage($id)
    {

        $user_account = User::find($id);

        return view('dashboard.pages.edit_user_account', ['user_account' => $user_account]);
    }

    public function updateUserAccount(Request $request)
    {

        //return $request;
        

        if(auth()->user()->type == 2)
        {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string',
                'email' => 'email',
                'type' => 'required|integer',
                'organisation_name' => 'required|string',
                'brief_description' => 'required|string',
                'detailed_description' => 'required|string',
                'password' => 'confirmed'
            ]);
        }
        else 
        {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'name' => 'required|string',
                'email' => 'email',
                'type' => 'required|integer',
                'password' => 'confirmed'
            ]);
        }


        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

       

        $user_account = User::find($request->id);

        if(!empty($request->name) )
        {
            $user_account->name = $request->name;
        }

        if(!empty($request->contact) )
        {
            $user_account->contact = $request->contact;
        }

        if(!empty($request->organisation_name) )
        {
            $user_account->organisation_name = $request->organisation_name;
        }

        if(!empty($request->brief_description) )
        {
            $user_account->brief_description = $request->brief_description;
        }

        if(!empty($request->detailed_description) )
        {
            $user_account->detailed_description = $request->detailed_description;
        }



        if(!empty($request->email) )
        {
            $user = User::where('email', $request->email)->first();

            if($user !== null && $user_account->email !== $request->email)
            {
              //  return back()->with(['error' => 'The new email is associated with another user account.']);
            }
            else 
            {
                $user_account->email = $request->email;
            }

        }

        if(!empty($request->type) )
        {
            $user_account->type = $request->type;
        }


        if(!empty($request->password) && !empty($request->password_confirmation))
        {
            $validator = Validator::make($request->all(), [
                'password' => 'confirmed'
            ]);

            if($request->password == $request->password_confirmation)
            {
                $user_account->password = Hash::make($request->password);
            }
           
        }

        if($user_account->save())
        {
            return back()->withSuccess('User account has been updated successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to update the User Account.']);
        }
    }

    public function showConfirmDeleteUserAccount($id)
    {
        return view('dashboard.pages.confirm_delete_user_account', ['id' => $id]);
    }

    public function deleteUserAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user_account = User::find($request->id);

        if($user_account->delete())
        {
            return redirect()->route('user.accounts')->withSuccess('User account ' . $user_account  . ' with email ' . $user_account->email . ' has been deleted successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to delete the User Account.']);
        }
    }
}
