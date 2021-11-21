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
            return back()->withErrors($validator);
        }

        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->contact = $request->contact;
        $new_user->type = $request->type;
        $new_user->password =  Hash::make($request->password);

        if($new_user->save())
        {
            return back()->withSuccess('New user account has been created successfully.');
        }
        else 
        {
            return back()->with(['error' => 'Failed to create the user account.']);
        }
    }

    public function showAccountsPage()
    {
        $user_accounts = User::paginate(20);

        return view('dashboard.pages.accounts',['user_accounts' => $user_accounts, 'no' => 1]);
    }
}
