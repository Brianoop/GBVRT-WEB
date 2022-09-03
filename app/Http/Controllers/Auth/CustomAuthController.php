<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaints;
use App\Models\SubCounties;
use App\Models\Violence;
use App\Models\UserCase;
use App\Models\ReportedUsers;
use App\Models\ActivistData;
use App\Models\ActivistServices;

class CustomAuthController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('login');
        }
       
    }  


    public function showLoginPage()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.login');
        }
    }

    public function showSignupPage()
    {
        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.signup');
        }
    }

    public function showDashboardHome() 
    {
            return view('dashboard.pages.home');
    }

    public function showForgotPasswordPage()
    {

        if(Auth::check())
        {
          return  redirect('/dashboard-home');
        }
        else 
        {
            return view('dashboard.pages.reset_password');
        }
    }
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $request->session()->regenerate();

            return redirect()->intended('dashboard-home')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('dashboard.pages.signup');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'contact' => 'required|numeric|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
           
        $data = $request->all();

        

        $check = $this->create($data);
         
        return redirect("signup")->withSuccess('You have registered');
    }


    public function create(array $data)
    {
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->contact = $data['contact'];
        $user->password = Hash::make($data['password']);

        return $user->save();

    //   return User::create([
    //     'name' => $data['name'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password'])
    //   ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut(Request $request) {
   
      Session::flush();

      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect('/');
    }

    public function getDashboardStatistics(Request $request)
    {
        $my_total_complaints = Complaints::where('users_id', auth()->user()->id)->get()->count();
        $my_total_cases = UserCase::where('users_id', auth()->user()->id)->get()->count();
        $my_total_chats = Chat::where(function($q) {
            $q->where('created_by', auth()->user()->id)
              ->orWhere('chatting_with', auth()->user()->id);
        })
        ->get()
        ->count();

        $total_cases = UserCase::get()->count();

        
        $total_reported_users = ReportedUsers::get()->count();
        $total_cases = UserCase::get()->count();
        $total_users = User::get()->count();
        $total_activists = User::where('type', 2)->get()->count();
        $total_victims = User::where('type', 3)->get()->count();
        $total_complaints = Complaints::get()->count();
        $total_chats = Chat::get()->count();

        

        return response()->json([
            'my_total_cases' => $my_total_cases,
            'my_total_complaints' => $total_complaints,
            'my_total_chats' => $my_total_chats,
            'total_activists' => $total_activists,
            'total_victims' => $total_victims,
            'total_reported_users' => $total_reported_users,
            'sms_balance' => 578,
            'total_users' => $total_users,
            'total_cases' => $total_cases,
            'total_chats' => $total_chats,
            'total_complaints' => $total_complaints
        ]);
    }
}
